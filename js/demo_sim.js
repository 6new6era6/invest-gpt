// Демо-симуляція: графік, угоди, CTA до форми
$(function(){
	// 1. Визначаємо asset
	const params = new URLSearchParams(window.location.search);
	let asset = params.get('asset') || 'BTC/UAH';
	let dataFile = asset.startsWith('EUR/PLN') ? '../demo/data/fx_EUR_PLN.json' : '../demo/data/crypto_btc_UAH.json';
	$('#demo-asset').text('Актив: ' + asset);

	// 2. Завантажуємо дані
	$.getJSON(dataFile, function(json){
		const arr = json.data || [];
		drawChart(arr);
		simulateTrades(arr);
	});

	// 3. Графік (простий SVG/Canvas)
	function drawChart(arr) {
		const canvas = document.getElementById('demo-chart');
		const ctx = canvas.getContext('2d');
		ctx.clearRect(0,0,canvas.width,canvas.height);
		// Лінія по close
		let min = Math.min(...arr.map(x=>x.c)), max = Math.max(...arr.map(x=>x.c));
		let scale = (canvas.height-40)/(max-min||1);
		ctx.beginPath();
		arr.forEach((x,i)=>{
			let y = canvas.height-20 - (x.c-min)*scale;
			let x0 = 40 + i*(canvas.width-60)/(arr.length-1);
			if(i===0) ctx.moveTo(x0,y); else ctx.lineTo(x0,y);
		});
		ctx.strokeStyle = '#2a7';
		ctx.lineWidth = 2;
		ctx.stroke();
		// Вісь Y
		ctx.fillStyle = '#888';
		ctx.font = '12px sans-serif';
		ctx.fillText(min, 5, canvas.height-20);
		ctx.fillText(max, 5, 20);
	}

	// 4. Симуляція угод (6–12, 1–2 збиткові)
	function simulateTrades(arr) {
		let n = Math.floor(6+Math.random()*6);
		let trades = [];
		let lossIdx = [];
		while(lossIdx.length<2) {
			let idx = Math.floor(Math.random()*n);
			if(!lossIdx.includes(idx)) lossIdx.push(idx);
		}
		for(let i=0;i<n;i++) {
			let open = arr[i%arr.length].c;
			let profit = lossIdx.includes(i) ? -Math.abs((Math.random()*0.03+0.01)*open) : Math.abs((Math.random()*0.07+0.01)*open);
			trades.push({
				dir: profit>0?'buy':'sell',
				open: open,
				close: open+profit,
				profit: profit
			});
		}
		let html = '<table class="trades"><tr><th>Угода</th><th>Відкр.</th><th>Закр.</th><th>Результат</th></tr>';
		trades.forEach((t,i)=>{
			html += `<tr><td>${i+1}</td><td>${t.open.toFixed(2)}</td><td>${t.close.toFixed(2)}</td><td style="color:${t.profit>0?'#2a7':'#d33'}">${t.profit>0?'+':'-'}${Math.abs(t.profit).toFixed(2)}</td></tr>`;
		});
		html += '</table>';
		$('#demo-trades').html(html);
		// Питання готовності
		askReadiness();
	}

	// 5. Питання готовності
	function askReadiness() {
		const q = [
			'Чи зрозуміла вам логіка симуляції?',
			'Чи готові ви перейти до фінальної форми?',
			'Чи бажаєте отримати консультацію?' 
		];
		let step = 0;
		$('#demo-questions').html(`<div>${q[0]}</div><input type="text" id="ready-input" placeholder="Ваша відповідь…"><button id="ready-next">Далі</button>`);
		$('#ready-next').on('click', function(){
			step++;
			if(step<q.length) {
				$('#demo-questions').html(`<div>${q[step]}</div><input type="text" id="ready-input" placeholder="Ваша відповідь…"><button id="ready-next">Далі</button>`);
				$('#ready-next').on('click', arguments.callee);
			} else {
				$('#demo-questions').html('<b>Дякуємо! Ви можете перейти до фінальної форми.</b>');
				$('#goto-form').show();
			}
		});
	}

	// 6. Кнопка до форми
	$('#goto-form').on('click', function(){
		window.location.href = '../index.php';
	});
});
