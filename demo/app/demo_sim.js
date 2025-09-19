// demo/app/demo_sim.js — інтеграційний адаптер
(function(){
  // Простий Emitter
  function Emitter(){ this._e={}; }
  Emitter.prototype.on=function(ev,fn){ (this._e[ev]||(this._e[ev]=[])).push(fn); return this; };
  Emitter.prototype.emit=function(ev,p){ (this._e[ev]||[]).forEach(f=>{ try{f(p);}catch{} }); };

  // RNG з seed (LCG)
  function RNG(seed){ this._s = (seed||Date.now())>>>0; }
  RNG.prototype.next = function(){ this._s = (1664525*this._s + 1013904223)>>>0; return this._s/0x100000000; };

  // Генерація series, якщо нема вендора/даних
  function genSeries(n, start, rng){
    const out=[]; let p=start||100; const r=rng||new RNG(); let t = Math.floor(Date.now()/1000) - n*60;
    for(let i=0;i<n;i++){
      const drift = (r.next()-0.5)*0.8;
      p = Math.max(5, p + drift);
      out.push({ time: t, value: +p.toFixed(2) });
      t+=60;
    }
    return out;
  }

  function pickDefaultAsset(){
    try{ const st = JSON.parse(sessionStorage.getItem('leadCtx')||'{}');
      const c = st?.currency || st?.auto_signals?.currency || 'USD';
      return `BTC/${c}`; }catch(_){ return 'BTC/USD'; }
  }

  function currencyFromCtx(){
    try{ const st = JSON.parse(sessionStorage.getItem('leadCtx')||'{}');
      return st?.currency || st?.auto_signals?.currency || 'USD'; }catch(_){ return 'USD'; }
  }

  function svgFallback(container, data){
    container.innerHTML=''; const w = container.clientWidth||640, h=container.clientHeight||300;
    const svg = document.createElementNS('http://www.w3.org/2000/svg','svg');
    svg.setAttribute('width', w); svg.setAttribute('height', h);
    svg.style.background = '#0b1020'; svg.style.borderRadius='12px';
    const vals = data.map(p=>p.value); const min = Math.min(...vals), max=Math.max(...vals);
    const dx = w / Math.max(1,(data.length-1)); const scaleY = v => h - ((v-min)/(max-min||1))*(h-20) - 10;
    let d=''; data.forEach((p,i)=>{ const x=i*dx, y=scaleY(p.value); d += (i?` L ${x},${y}`:`M ${x},${y}`); });
    const path = document.createElementNS(svg.namespaceURI,'path');
    path.setAttribute('d', d); path.setAttribute('stroke', '#5ad67d'); path.setAttribute('fill','none'); path.setAttribute('stroke-width','2');
    svg.appendChild(path); container.appendChild(svg);
  }

  function createChart(container){
    return {
      setData(data){
        if (window.LightweightCharts && typeof LightweightCharts.createChart==='function'){
          if(!this._chart){
            this._chart = LightweightCharts.createChart(container, {
              width: container.clientWidth||640,
              height: container.clientHeight||300,
              layout: { background: { color: '#0b1020' }, textColor: '#cdd6f4' },
              grid: { vertLines: { color: '#1b2238' }, horzLines: { color: '#1b2238' } },
              rightPriceScale: { borderVisible: false }, timeScale: { borderVisible: false }
            });
            this._series = this._chart.addLineSeries({ color:'#5ad67d', lineWidth:2 });
            window.addEventListener('resize', ()=>{ this._chart.applyOptions({ width: container.clientWidth||640 }); });
          }
          this._series.setData(data);
        } else {
          svgFallback(container, data);
        }
      }
    };
  }

  function simulateTrades(series, rng){
    const r = rng||new RNG();
    const trades=[]; let i=10; while(i<series.length-5 && trades.length<12){
      const step = 5 + Math.floor(r.next()*8);
      const entry = series[i]; const exit = series[i+Math.max(3, Math.floor(r.next()*5))];
      const side = r.next()>0.4?1:-1; const pnl = side * ((exit.value-entry.value)/entry.value) * 100;
      trades.push({ timeIn:entry.time, timeOut:exit.time, side: side>0?'LONG':'SHORT', entry:entry.value, exit:exit.value, pnl:+pnl.toFixed(2) });
      i += step;
    }
    // гарантуємо 1–2 збиткові
    if (trades.filter(t=>t.pnl<0).length===0 && trades.length){ trades[0].pnl = -Math.abs(trades[0].pnl||1.2); }
    return trades;
  }

  function calcSummary(trades){
    const pnl = trades.reduce((s,t)=>s+t.pnl,0);
    const wins = trades.filter(t=>t.pnl>0).length; const total = trades.length||1;
    const winRate = +(wins/total*100).toFixed(2);
    return { pnl:+pnl.toFixed(2), trades: trades.length, winRate };
  }

  function DemoImpl(){ this.em = new Emitter(); }
  DemoImpl.prototype.init = function(container, options){
    this.container = (typeof container==='string')? document.querySelector(container) : container;
    const qs = new URLSearchParams(location.search);
    const asset = options?.asset || qs.get('asset') || pickDefaultAsset();
    const currency = options?.currency || currencyFromCtx();
    const amount = options?.amount || 1000;
    const seed = options?.seed || undefined;
    const rng = new RNG(seed);
    this.state = { asset, currency, amount, speed: options?.speed||'normal', rng };
    // заголовок
    const title = document.getElementById('demo-asset'); if (title) title.textContent = asset;
    // графік
    this.chart = createChart(this.container);
    const base = /UAH|PLN|TRY|EUR/.test(asset) ? 100 : 30000;
    this.series = genSeries(180, base, rng);
    this.chart.setData(this.series);
    // трейди
    this.trades = [];
    this._timer = null; this._idx = 0; this._playing=false;
    this.em.emit('ready', { asset, currency, amount });
    return this;
  };
  DemoImpl.prototype.loadAsset = function(asset){ this.state.asset = asset; const title=document.getElementById('demo-asset'); if(title) title.textContent=asset; };
  DemoImpl.prototype.setAmount = function(v){ this.state.amount = Number(v)||this.state.amount; };
  DemoImpl.prototype.setSpeed = function(mode){ this.state.speed = mode; };
  DemoImpl.prototype._tick = function(){
    if (this._idx>= (this._plan?.length||0)) { this._stop(); const sum = calcSummary(this.trades); this.em.emit('summary', sum); return; }
    const t = this._plan[this._idx++];
    this.trades.push(t);
    this.em.emit('trade', { ...t, idx:this._idx });
  };
  DemoImpl.prototype.start = function(){
    if (this._playing) return; this._playing = true;
    if (!this._plan){ this._plan = simulateTrades(this.series, this.state.rng); this._idx=0; this.trades=[]; }
    const interval = this.state.speed==='fast'? 350 : this.state.speed==='slow'? 1100 : 700;
    this._timer = setInterval(()=>this._tick(), interval);
  };
  DemoImpl.prototype.pause = function(){ this._playing=false; if(this._timer) clearInterval(this._timer); this._timer=null; };
  DemoImpl.prototype._stop = function(){ this.pause(); };
  DemoImpl.prototype.reset = function(){ this.pause(); this._plan=null; this._idx=0; this.trades=[]; this.em.emit('ready', { asset:this.state.asset, currency:this.state.currency, amount:this.state.amount }); };
  DemoImpl.prototype.destroy = function(){ this.reset(); this.container.innerHTML=''; };
  DemoImpl.prototype.on = function(ev,fn){ this.em.on(ev,fn); return this; };

  // Експортуємо глобальний API
  window.Demo = {
    _impl: new DemoImpl(),
    init: function(container, options){ return this._impl.init(container, options); },
    loadAsset: function(a){ return this._impl.loadAsset(a); },
    setAmount: function(v){ return this._impl.setAmount(v); },
    setSpeed: function(m){ return this._impl.setSpeed(m); },
    start: function(){ return this._impl.start(); },
    pause: function(){ return this._impl.pause(); },
    reset: function(){ return this._impl.reset(); },
    destroy: function(){ return this._impl.destroy(); },
    on: function(e,h){ return this._impl.on(e,h); }
  };

  // Прив'язуємо до UI контейнера
  document.addEventListener('DOMContentLoaded', function(){
    const qs = new URLSearchParams(location.search);
    const asset = qs.get('asset') || pickDefaultAsset();
    const ctx = JSON.parse(sessionStorage.getItem('leadCtx')||'{}');
    const startBudget = ctx?.answers?.start_budget ? Number(ctx.answers.start_budget) : undefined;
    const currency = ctx?.currency || ctx?.auto_signals?.currency || 'USD';

    Demo.init('#demo-chart', { asset, currency, amount: startBudget||1000, speed:'normal' })
      .on('ready', () => {
        // нулі
        setText('#pnl','0.00%'); setText('#trades','0'); setText('#winrate','0%');
        bySel('#demo-trades').innerHTML='';
      })
      .on('trade', (t) => {
        const row = document.createElement('div'); row.className='trade-row';
        const sign = t.pnl>=0?'+':''; const cls = t.pnl>=0?'pos':'neg';
        row.innerHTML = `<span class="side ${t.side.toLowerCase()}">${t.side}</span>
          <span>Entry: ${t.entry.toFixed(2)}</span>
          <span>Exit: ${t.exit.toFixed(2)}</span>
          <span class="pnl ${cls}">${sign}${t.pnl.toFixed(2)}%</span>`;
        bySel('#demo-trades').appendChild(row);
        // оновлення агрегатів
        const list = Demo._impl.trades;
        const sum = calcSummary(list);
        setText('#pnl', `${sum.pnl>=0?'+':''}${sum.pnl.toFixed(2)}%`);
        setText('#trades', `${sum.trades}`);
        setText('#winrate', `${sum.winRate}%`);
      })
      .on('summary', (s) => {
        // показ пост-демо
        bySel('#postdemo').classList.remove('hidden');
        // збереження в leadCtx
        const lead = JSON.parse(sessionStorage.getItem('leadCtx')||'{}');
        lead.demo = { lastAsset: asset, selectedAmount: Demo._impl.state.amount, runSummary: s };
        sessionStorage.setItem('leadCtx', JSON.stringify(lead));
      });

    // Контролі
    document.getElementById('btn-start').addEventListener('click', ()=> Demo.start());
    document.getElementById('btn-pause').addEventListener('click', ()=> Demo.pause());
    document.getElementById('btn-reset').addEventListener('click', ()=> Demo.reset());
    document.getElementById('speed').addEventListener('change', e=> Demo.setSpeed(e.target.value));
    document.querySelectorAll('[data-amt]').forEach(b=> b.addEventListener('click', ()=> Demo.setAmount(b.dataset.amt)));

    // Пост-демо валідація/продовження
    const pd = { budget: '', segment:'', when:'' };
    ['pd-budget','pd-segment','pd-when'].forEach(id=> byId(id).addEventListener('change', ()=>{
      pd.budget = byId('pd-budget').value; pd.segment = byId('pd-segment').value; pd.when = byId('pd-when').value;
      const ok = pd.budget && pd.segment && pd.when;
      byId('pd-continue').disabled = !ok;
    }));
    byId('pd-continue').addEventListener('click', ()=>{
      const lead = JSON.parse(sessionStorage.getItem('leadCtx')||'{}');
      lead.postdemo = { budget: pd.budget, segment: pd.segment, startWhen: pd.when };
      sessionStorage.setItem('leadCtx', JSON.stringify(lead));
      window.location.href = '../index.php';
    });
  });

  function bySel(s){ return document.querySelector(s); }
  function byId(id){ return document.getElementById(id); }
  function setText(s, t){ const el = bySel(s); if (el) el.textContent = t; }
})();
