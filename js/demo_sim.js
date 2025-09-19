// js/demo_sim.js — самодостатня симуляція, без сторонніх бібліотек
(function(){
	const qs = new URLSearchParams(location.search);
	const asset = qs.get('asset') || pickDefaultAsset();
	document.getElementById('asset').textContent = asset;

	const c = document.getElementById('chart');
	const ctx = c.getContext('2d');

	function resize() {
		c.width = c.clientWidth * (window.devicePixelRatio || 1);
		c.height = 360 * (window.devicePixelRatio || 1);
	}
	resize(); window.addEventListener('resize', resize);

	// 1) Генеруємо синтетичний тренд із шумом
	function genSeries(n=120) {
		const arr = [];
		let v = 100;
		for (let i=0;i<n;i++){
			const drift = 0.08; // легкий ап-тренд
			const noise = (Math.random()-0.5)*1.6;
			v = Math.max(60, v + drift + noise);
			arr.push(v);
		}
		return arr;
	}
	const series = genSeries();

	// 2) Малюємо лінійний графік
	function drawChart(highlights=[]) {
		ctx.clearRect(0,0,c.width,c.height);
		const w = c.width, h = c.height, pad = 20*(window.devicePixelRatio||1);
		const min = Math.min(...series), max = Math.max(...series);
		const x = i => pad + (w - 2*pad) * (i/(series.length-1));
		const y = v => h - pad - (h - 2*pad) * ((v-min)/(max-min));

		// Осі
		ctx.strokeStyle = '#e5e7eb'; ctx.lineWidth = 1*(window.devicePixelRatio||1);
		ctx.beginPath();
		ctx.moveTo(pad, pad); ctx.lineTo(pad, h-pad); ctx.lineTo(w-pad, h-pad);
		ctx.stroke();

		// Лінія ціни
		ctx.strokeStyle = '#111827'; ctx.lineWidth = 2*(window.devicePixelRatio||1);
		ctx.beginPath();
		series.forEach((v,i)=>{ const X=x(i), Y=y(v); i?ctx.lineTo(X,Y):ctx.moveTo(X,Y); });
		ctx.stroke();

		// Точки ордерів
		highlights.forEach(o=>{
			const X = x(o.i), Y = y(o.price);
			ctx.fillStyle = o.type==='buy' ? '#10b981' : '#ef4444';
			ctx.beginPath(); ctx.arc(X, Y, 4*(window.devicePixelRatio||1), 0, Math.PI*2); ctx.fill();
		});
	}

	// 3) Симуляція угод: декілька плюсових, 1–2 збиткові
	function simulate(amount) {
		const orders = [];
		let cash = 0;
		let pos = 0;
		const unit = Math.max(1, Math.floor(amount / 100)); // умовні "контракти"

		const idxs = [10, 25, 40, 55, 70, 85, 100];
		const lossesAt = new Set([2]); // зробимо збиток на 3-й угоді

		for (let k=0; k<idxs.length-1; k++) {
			const iBuy = idxs[k], iSell = idxs[k+1];
			const buyP  = series[iBuy];
			const sellBase = series[iSell];

			// відкриваємо
			orders.push({ type:'buy', i:iBuy, price:buyP, qty:unit });
			pos += unit; cash -= unit * buyP;

			// закриваємо (інколи зі збитком)
			const sellPrice = lossesAt.has(k) ? Math.max(60, buyP - (Math.random()*3+1)) : sellBase;
			orders.push({ type:'sell', i:iSell, price:sellPrice, qty:unit });
			pos -= unit; cash += unit * sellPrice;
		}

		const pnl = cash; // позицію закрили повністю
		const pnlPct = ((pnl) / (amount * 3)).toFixed(2); // умовна база
		return { orders, pnl, pnlPct };
	}

	function fmt(n) { return Number(n).toFixed(2); }

	const ordersBox = document.getElementById('orders');
	const pnlEl = document.getElementById('pnl');
	const runBtn = document.getElementById('run');
	const amountSel = document.getElementById('amount');

	function run() {
		const amount = Number(amountSel.value || 1000);
		const { orders, pnl, pnlPct } = simulate(amount);
		ordersBox.innerHTML = '';
		const highlights = [];

		for (let i=0;i<orders.length;i+=2) {
			const buy = orders[i], sell = orders[i+1];
			const p = (sell.price - buy.price) * buy.qty;
			const color = p >= 0 ? '#065f46' : '#991b1b';
			ordersBox.innerHTML +=
				`<div><b>${i/2+1}.</b> Buy ${buy.qty}@${fmt(buy.price)} → Sell ${sell.qty}@${fmt(sell.price)} `+
				`<span style="color:${color}">PnL: ${fmt(p)}</span></div>`;
			highlights.push({ type:'buy', i:buy.i, price:buy.price });
			highlights.push({ type:'sell', i:sell.i, price:sell.price });
		}
		drawChart(highlights);

		const color = pnl >= 0 ? '#065f46' : '#991b1b';
		pnlEl.innerHTML = `<span style="color:${color}">${fmt(pnl)} (${pnl >= 0 ? '+' : ''}${pnlPct}%)</span> — це лише <i>освітня симуляція</i>, не гарантія результату.`;
	}

	drawChart([]);
	runBtn.addEventListener('click', run);
	document.getElementById('to-form').addEventListener('click', () => {
		window.location.href = '../index.php';
	});

	function pickDefaultAsset() {
		try {
			const st = JSON.parse(sessionStorage.leadCtx || '{}');
			const curr = st?.currency || st?.auto_signals?.currency || 'USD';
			return `BTC/${curr}`;
		} catch(_){ return 'BTC/USD'; }
	}
})();
