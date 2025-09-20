<!DOCTYPE html>
<html lang="uk" data-theme="light">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>InvestGPT Funnel — Onboarding</title>
	<link rel="icon" href="images/favicon.ico">
	<link rel="stylesheet" href="css/flow.css">
	<link rel="stylesheet" href="css/funnel.css">
	<link rel="stylesheet" href="css/chat.css">
		<!-- Vendor demo styles for unified look -->
		<link rel="stylesheet" href="demo/vendor/css/vendor_bundle.css">
		<link rel="stylesheet" href="demo/vendor/css/adict.css">
		<link rel="stylesheet" href="demo/vendor/css/introjs.min.css">
	<style>
		.ob-container{max-width:960px;margin:0 auto;padding:24px}
		.ob-card{background:#0f172a;color:#e2e8f0;border-radius:16px;padding:24px;box-shadow:0 10px 25px rgba(2,6,23,.4)}
		.ob-steps{display:flex;gap:8px;margin-bottom:12px}
		.ob-dot{width:8px;height:8px;border-radius:999px;background:#334155;opacity:.4}
		.ob-dot.active{opacity:1;background:#22d3ee}
		.ob-title{font-size:24px;line-height:1.2;margin:4px 0 8px}
		.ob-sub{color:#94a3b8;margin-bottom:16px}
		.ob-actions{display:flex;gap:12px;justify-content:flex-end;margin-top:16px}
		.btn{background:#22c55e;color:#04151a;border:none;padding:10px 16px;border-radius:10px;cursor:pointer;font-weight:600}
		.btn.secondary{background:#0ea5e9;color:#04151a}
		.btn.ghost{background:transparent;border:1px solid #334155;color:#e2e8f0}
		.grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
		.field{display:flex;flex-direction:column;gap:6px}
		.field label{color:#94a3b8;font-size:14px}
		.field input,.field select,.field textarea{background:#0b1220;border:1px solid #1f2937;color:#e5e7eb;border-radius:8px;padding:10px}
		.pill{display:inline-block;background:#0ea5e9;color:#04151a;border-radius:999px;padding:6px 10px;margin:4px 6px 0 0;font-size:12px}
		.disclaimer{margin-top:16px;color:#64748b;font-size:12px}
	</style>
	<script>
		// Minimal i18n dictionary
		const I18N = {
			uk: {
				welcome: 'Вітаємо в InvestGPT',
				pitch: 'Побудуємо персональний інвест-план під ваш стиль життя',
				chooseLang: 'Оберіть мову інтерфейсу',
				next: 'Далі', back: 'Назад', start: 'Почати чат',
				profileTitle: 'Розкажіть про себе',
				income: 'Місячний дохід', job: 'Рід занять', hobbies: 'Хобі',
				family: 'Сімейний статус', goal: 'Головна ціль', purpose: 'Мета життя',
				ex1: 'поїздки з сім’єю', ex2: 'пасивний дохід', ex3: 'своя справа',
				commit: 'Ваші мрії досяжні. Бот допоможе рухатися крок за кроком.'
			},
			en: {
				welcome: 'Welcome to InvestGPT',
				pitch: 'We will craft a personal investing plan for your lifestyle',
				chooseLang: 'Choose your language',
				next: 'Next', back: 'Back', start: 'Start Chat',
				profileTitle: 'Tell us about yourself',
				income: 'Monthly income', job: 'Occupation', hobbies: 'Hobbies',
				family: 'Family status', goal: 'Main goal', purpose: 'Life purpose',
				ex1: 'travel with family', ex2: 'passive income', ex3: 'own business',
				commit: 'Your dreams are achievable. This bot will guide you step by step.'
			}
		};

		function saveProfile(p){
			try{
				const st = JSON.parse(localStorage.getItem('leadProfile')||'{}');
				const merged = { ...st, ...p, ts: Date.now() };
				localStorage.setItem('leadProfile', JSON.stringify(merged));
				sessionStorage.leadCtx = JSON.stringify({ ...(JSON.parse(sessionStorage.leadCtx||'{}')), profile: merged });
			}catch(e){}
		}
		function setLang(lang){
			localStorage.setItem('lang', lang);
			document.documentElement.lang = lang;
		}
		async function detectCurrency(){
			// Try backend IP geo first; fallback to navigator.language
			try{
				const res = await fetch('api/geo.php', { method:'GET', headers:{'Accept':'application/json'} });
				if(res.ok){
					const j = await res.json();
					if (j && j.currency) { localStorage.setItem('currency', j.currency); return j.currency; }
					if (j && j.country_code){
						const map = { UA:'UAH', PL:'PLN', DE:'EUR', FR:'EUR', ES:'EUR', IT:'EUR', PT:'EUR', NL:'EUR', BE:'EUR', AT:'EUR', IE:'EUR', FI:'EUR', LT:'EUR', LV:'EUR', EE:'EUR', SK:'EUR', SI:'EUR', MT:'EUR', CY:'EUR', LU:'EUR' };
						const cur = map[j.country_code] || 'USD';
						localStorage.setItem('currency', cur); return cur;
					}
				}
			}catch(e){}
			try{
				const lang = navigator.language || 'en-US';
				const cc = (lang.split('-')[1]||'US').toUpperCase();
				const map = { UA:'UAH', PL:'PLN', GB:'GBP', EU:'EUR', DE:'EUR', FR:'EUR', ES:'EUR', IT:'EUR', PT:'EUR' };
				const cur = map[cc] || 'USD';
				localStorage.setItem('currency', cur);
				return cur;
			}catch(e){ localStorage.setItem('currency','USD'); return 'USD'; }
		}
		function fillExamples(el, t){
			el.querySelector('#ex1').textContent = t.ex1;
			el.querySelector('#ex2').textContent = t.ex2;
			el.querySelector('#ex3').textContent = t.ex3;
		}
		document.addEventListener('DOMContentLoaded', async () => {
			// Step state
			let step = 1;
			const langSel = document.getElementById('lang-select');
			const steps = Array.from(document.querySelectorAll('.ob-dot'));
			const title = document.getElementById('ob-title');
			const sub = document.getElementById('ob-sub');
			const nextBtn = document.getElementById('next-btn');
			const backBtn = document.getElementById('back-btn');
			const startBtn = document.getElementById('start-btn');
			const scr1 = document.getElementById('screen-1');
			const scr2 = document.getElementById('screen-2');
			const scr3 = document.getElementById('screen-3');
			const locale = localStorage.getItem('lang') || 'uk';
			langSel.value = locale;
			setLang(locale);
			const t = I18N[locale] || I18N.uk;
			title.textContent = t.welcome;
			sub.textContent = t.pitch;
			document.getElementById('choose-lang-label').textContent = t.chooseLang;
			nextBtn.textContent = t.next; backBtn.textContent = t.back; startBtn.textContent = t.start;
			document.querySelector('label[for="income"]').textContent = t.income;
			document.querySelector('label[for="job"]').textContent = t.job;
			document.querySelector('label[for="hobbies"]').textContent = t.hobbies;
			document.querySelector('label[for="family"]').textContent = t.family;
			document.querySelector('label[for="goal"]').textContent = t.goal;
			document.querySelector('label[for="purpose"]').textContent = t.purpose;
			document.getElementById('commit-text').textContent = t.commit;
			fillExamples(document, t);

			langSel.addEventListener('change', e=>{
				const l = e.target.value; setLang(l); location.reload();
			});

			detectCurrency(); // fire and forget

			function updateDots(){ steps.forEach((d,i)=>{ d.classList.toggle('active', i<step); }); }
			function show(n){ step=n; updateDots();
				scr1.style.display = n===1?'block':'none';
				scr2.style.display = n===2?'block':'none';
				scr3.style.display = n===3?'block':'none';
			}

			nextBtn.addEventListener('click', ()=>{ show(2); });
			backBtn.addEventListener('click', ()=>{ show(1); });
			startBtn.addEventListener('click', ()=>{
				// collect profile
				const p = {
					lang: localStorage.getItem('lang')||'uk',
					income: (document.getElementById('income').value||'').trim(),
					job: (document.getElementById('job').value||'').trim(),
					hobbies: (document.getElementById('hobbies').value||'').trim(),
					family: (document.getElementById('family').value||'').trim(),
					goal: (document.getElementById('goal').value||'').trim(),
					purpose: (document.getElementById('purpose').value||'').trim(),
				};
				saveProfile(p);
				// Go to chat preserving UTM params
				const qp = new URLSearchParams(location.search);
				qp.set('lang', p.lang);
				const url = 'chat/index.html?' + qp.toString();
				window.location.href = url;
			});

			show(1);
		});
	</script>
</head>
<body>
	<div class="ob-container">
		<div class="ob-card">
			<div class="ob-steps"><span class="ob-dot active"></span><span class="ob-dot"></span><span class="ob-dot"></span></div>
			<h1 id="ob-title" class="ob-title">Welcome</h1>
			<p id="ob-sub" class="ob-sub">Personal investing plan</p>

			<!-- Screen 1: Language & pitch -->
			<section id="screen-1">
				<div class="field" style="max-width:280px">
					<label id="choose-lang-label" for="lang-select">Choose language</label>
					<select id="lang-select">
						<option value="uk">Українська</option>
						<option value="en">English</option>
					</select>
				</div>
				<div class="pill" id="ex1">travel with family</div>
				<div class="pill" id="ex2">passive income</div>
				<div class="pill" id="ex3">own business</div>
				<div class="ob-actions"><button id="next-btn" class="btn">Next</button></div>
			</section>

			<!-- Screen 2: Profile form -->
			<section id="screen-2" style="display:none">
				<h2 class="ob-title" id="profile-title">Profile</h2>
				<div class="grid">
					<div class="field">
						<label for="income">Monthly income</label>
						<select id="income">
							<option value="" selected>-</option>
							<option>< $1,000</option>
							<option>$1,000–$3,000</option>
							<option>$3,000–$7,000</option>
							<option>$7,000–$15,000</option>
							<option>> $15,000</option>
						</select>
					</div>
					<div class="field">
						<label for="job">Occupation</label>
						<input id="job" type="text" placeholder="Developer, Sales, Self-employed...">
					</div>
					<div class="field">
						<label for="hobbies">Hobbies</label>
						<input id="hobbies" type="text" placeholder="Gym, hiking, music...">
					</div>
					<div class="field">
						<label for="family">Family status</label>
						<select id="family">
							<option value="" selected>-</option>
							<option>Single</option>
							<option>In relationship</option>
							<option>Married</option>
							<option>Kids</option>
						</select>
					</div>
					<div class="field" style="grid-column:1/-1">
						<label for="goal">Main goal</label>
						<input id="goal" type="text" placeholder="Buy a home, freedom, education...">
					</div>
					<div class="field" style="grid-column:1/-1">
						<label for="purpose">Life purpose</label>
						<textarea id="purpose" rows="3" placeholder="What matters most in your life?"></textarea>
					</div>
				</div>
				<div class="ob-actions">
					<button id="back-btn" class="btn ghost">Back</button>
					<button id="to-screen-3" class="btn secondary" onclick="(function(){document.getElementById('screen-2').style.display='none';document.getElementById('screen-3').style.display='block';Array.from(document.querySelectorAll('.ob-dot')).forEach((d,i)=>d.classList.toggle('active',i<3));})();return false;">Next</button>
				</div>
			</section>

			<!-- Screen 3: Commitment & CTA -->
			<section id="screen-3" style="display:none">
				<p id="commit-text" class="ob-sub">Your dreams are achievable. This bot will guide you step by step.</p>
				<div class="ob-actions">
					<button id="start-btn" class="btn">Start Chat</button>
				</div>
				<div class="disclaimer">Educational simulation. Not investment advice.</div>
			</section>
		</div>
	</div>

</body>
</html>
