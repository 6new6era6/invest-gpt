<!DOCTYPE html><html lang="en"><head>
    <script src="js/jquery-3.6.4.min.js" crossorigin="anonymous"></script>
<script src="js/intlTelInput.js"></script>
<script src="js/adict.js"></script>
<script src="js/utils.js"></script>
<link rel="stylesheet" href="css/intlTelInput.css">
<link rel="stylesheet" href="css/adict.css">

  <link rel="icon" type="image/png" href="images/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/svg+xml" href="images/favicon.svg">
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
 
<style>
/* Базовые стили для мобильной обучалки */
@media (max-width: 768px) {
  /* Принудительно показываем все элементы обучалки */
  .introjs-overlay, 
  .introjs-helperLayer, 
  .introjs-tooltipReferenceLayer, 
  .introjs-tooltip {
    display: block !important;
    opacity: 1 !important;
    visibility: visible !important;
  }
  
  /* Фиксируем диалог внизу экрана */
  .introjs-tooltip {
    position: fixed !important;
    top: auto !important;
    bottom: 0 !important;
    left: 0 !important;
    right: 0 !important;
    width: 100% !important;
    max-width: 100% !important;
    margin: 0 !important;
    border-radius: 12px 12px 0 0 !important;
    box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.3) !important;
    z-index: 999999999 !important;
    transform: none !important;
    transition: none !important;
    height: auto !important;
    min-height: 150px !important;
    max-height: 40% !important;
    overflow-y: auto !important;
  }
  
  /* Скрываем стрелку */
  .introjs-arrow {
    display: none !important;
  }
  
  /* Увеличиваем z-index для всех элементов туториала */
  .introjs-overlay {
    z-index: 999999990 !important;
  }
  
  .introjs-helperLayer {
    z-index: 999999991 !important;
  }
  
  .introjs-tooltipReferenceLayer {
    z-index: 999999992 !important;
  }
  
  /* Скрываем кнопку пропуска */
  .introjs-skipbutton {
    display: none !important;
  }
  
  /* Делаем кнопки больше для удобства на мобильных */
  .introjs-button {
    padding: 12px 15px !important;
    font-size: 16px !important;
    margin: 5px !important;
    display: inline-block !important;
    visibility: visible !important;
    opacity: 1 !important;
  }
  
  /* Убираем все трансформации и переходы */
  .introjs-tooltip, 
  .introjs-helperLayer, 
  .introjs-tooltipReferenceLayer {
    transform: none !important;
    transition: none !important;
    animation: none !important;
  }
  
  /* Принудительно показываем контент */
  .introjs-tooltiptext {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
  }
  
  /* Принудительно показываем кнопки */
  .introjs-tooltipbuttons {
    display: flex !important;
    visibility: visible !important;
    opacity: 1 !important;
    justify-content: space-between !important;
  }
  

  
  /* Исключаем элементы туториала из правила выше */
  .introjs-overlay, 
  .introjs-helperLayer, 
  .introjs-tooltipReferenceLayer, 
  .introjs-tooltip, 
  .introjs-tooltip * {
    z-index: 9999999 !important;
  }
}
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Micronyx AI | Trading Bot Demo Tutorial</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Chart.js for graphs -->
    <script src="js/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation"></script>
    
   
    <link rel="stylesheet" href="css/introjs.min.css">
    <script src="js/intro.min.js"></script>
    <link rel="icon" type="image/png" href="images/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/svg+xml" href="images/favicon.svg">
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">

    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --primary-light: #60a5fa;
            --secondary: #10b981;
            --secondary-dark: #059669;
            --accent: #8b5cf6;
            --accent-dark: #7c3aed;
            --neutral: #6b7280;
            --neutral-dark: #4b5563;
            --warning: #f59e0b;
            --warning-dark: #d97706;
            --dark: #0f172a;
            --darker: #020617;
            --light: #f3f4f6;
            --lighter: #f9fafb;
            --chart-bg: #111827;
            --card-bg: #1e293b;
            --card-border: #334155;
        }
        
        body {
            background-color: var(--darker);
            color: var(--light);
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .card {
            background-color: var(--card-bg);
            border-radius: 0.5rem;
            border: 1px solid var(--card-border);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
            transition: all 0.2s ease;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
        }
        
        .btn-secondary {
            background-color: var(--secondary);
            color: white;
            transition: all 0.2s ease;
        }
        
        .btn-secondary:hover {
            background-color: var(--secondary-dark);
        }
        
        .btn-accent {
            background-color: var(--accent);
            color: white;
            transition: all 0.2s ease;
        }
        
        .btn-accent:hover {
            background-color: var(--accent-dark);
        }
        
        .btn-neutral {
            background-color: var(--neutral);
            color: white;
            transition: all 0.2s ease;
        }
        
        .btn-neutral:hover {
            background-color: var(--neutral-dark);
        }
        
        /* Custom style for slider */
        input[type="range"] {
            -webkit-appearance: none;
            width: 100%;
            height: 8px;
            border-radius: 5px;
            background: #334155;
            outline: none;
        }
        
        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--primary);
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        input[type="range"]::-webkit-slider-thumb:hover {
            background: var(--primary-dark);
            transform: scale(1.1);
        }
        
        /* Transaction animation */
        .trade-card {
            background-color: rgba(30, 41, 59, 0.8);
            border-left: 4px solid var(--neutral);
            border-radius: 0.25rem;
            padding: 0.75rem;
            margin-bottom: 0.5rem;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            backdrop-filter: blur(4px);
        }
        
        .trade-card.buy {
            border-left-color: var(--neutral);
        }
        
        .trade-card.sell {
            border-left-color: var(--secondary);
        }
        
        .trade-card.active {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Profit/loss indicators */
        .profit {
            color: var(--secondary);
        }
        
        .loss {
            color: var(--neutral);
        }
        
        /* Animated loading dots */
        .loading-dots:after {
            content: '.';
            animation: dots 1.5s steps(5, end) infinite;
        }
        
        @keyframes dots {
            0%, 20% { content: '.'; }
            40% { content: '..'; }
            60% { content: '...'; }
            80%, 100% { content: ''; }
        }
        
        /* Pulse animation for buttons */
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(59, 130, 246, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
            }
        }
        
        /* Market selection style */
        .market-option {
            cursor: pointer;
            transition: all 0.2s ease;
            border: 2px solid transparent;
        }
        
        .market-option:hover {
            background-color: rgba(59, 130, 246, 0.1);
        }
        
        .market-option.selected {
            border-color: var(--primary);
            background-color: rgba(59, 130, 246, 0.1);
        }
        
        /* Tab style */
        .tab {
            cursor: pointer;
            transition: all 0.2s ease;
            border-bottom: 2px solid transparent;
        }
        
        .tab:hover {
            color: var(--primary);
        }
        
        .tab.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }
        
        /* Tooltip style */
        .tooltip {
            position: relative;
            display: inline-block;
        }
        
        .tooltip .tooltip-text {
            visibility: hidden;
            width: 200px;
            background-color: var(--card-bg);
            color: var(--light);
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid #334155;
        }
        
        .tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }
        
        /* Chart style inspired by crypto exchanges */
        .chart-container {
            background-color: var(--chart-bg);
            border-radius: 0.5rem;
            border: 1px solid var(--card-border);
            overflow: hidden;
        }
        
        /* Live trades style */
        .live-trades-container {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 280px;
            max-height: 80%;
            overflow-y: auto;
            z-index: 11;
                overflow: hidden; /* ← отключает скролл */

        }
        
        @media (max-width: 768px) {
            .live-trades-container {
                position: fixed;
                bottom: 10px;
                top: auto;
                right: 10px;
                width: calc(100% - 20px);
                max-height: 30%;
            }
        }
        
        /* Balance chart style */
        .balance-chart {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background-color: rgba(15, 23, 42, 0.8);
            padding: 10px;
            border-radius: 0.5rem;
            border: 1px solid var(--card-border);
            backdrop-filter: blur(4px);
            z-index: 10;
        }
        
        /* Chart grid style */
        .chart-grid {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 20px 20px;
            pointer-events: none;
            z-index: 1;
        }
        
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 100;
            align-items: center;
            justify-content: center;
        }
        
        .modal-content {
            background-color: var(--card-bg);
            border-radius: 0.5rem;
            border: 1px solid var(--card-border);
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            padding: 1.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        /* Intro.js customization */
        .introjs-tooltip {
            background-color: var(--card-bg);
            color: var(--light);
            border: 1px solid var(--card-border);
        }
        
        .introjs-helperNumberLayer {
            background: var(--primary);
        }
        
        .introjs-arrow.top {
            border-bottom-color: var(--card-bg);
        }
        
        .introjs-arrow.right {
            border-left-color: var(--card-bg);
        }
        
        .introjs-arrow.bottom {
            border-top-color: var(--card-bg);
        }
        
        .introjs-arrow.left {
            border-right-color: var(--card-bg);
        }
        
        .introjs-button {
            background-color: var(--primary);
            color: white;
            text-shadow: none;
            border: none;
        }
        
        .introjs-button:hover {
            background-color: var(--primary-dark);
            color: white;
            box-shadow: none;
        }
        
        .introjs-skipbutton {
            color: var(--light);
        }
        
        .introjs-prevbutton {
            border-right: 1px solid var(--primary-dark);
        }
        
        /* Strategy recommendation badge */
        .strategy-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: var(--secondary);
            color: white;
            font-size: 0.7rem;
            padding: 0.1rem 0.4rem;
            border-radius: 0.25rem;
            margin-left: 0.5rem;
            vertical-align: middle;
        }
        
        /* No balance overlay */
        .no-balance-overlay {
            position: absolute;
            inset: 0;
            background-color: rgba(15, 23, 42, 0.9);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 50;
            text-align: center;
            padding: 1rem;
        }
        
        /* Trade markers on chart */
        .trade-marker {
            position: absolute;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
            z-index: 5;
            transform: translate(-50%, -50%);
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }
        
        .trade-marker.buy {
            background-color: #6b7280;
            color: white;
        }
        
        .trade-marker.sell {
            background-color: #10b981;
            color: white;
        }
        
        /* Withdrawal method selection */
        .withdraw-method {
            transition: all 0.2s ease;
            border: 2px solid transparent;
        }
        
        .withdraw-method.selected {
            border-color: var(--primary);
        }
        
        /* Welcome modal */
        .welcome-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        
        .welcome-content {
            background-color: var(--card-bg);
            border-radius: 0.5rem;
            border: 1px solid var(--card-border);
            width: 90%;
            max-width: 600px;
            padding: 2rem;
            text-align: center;
        }
        
        /* Market icons fix */
        .market-icon {
            min-width: 20px;
            min-height: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Fix for commodities text alignment */
        .market-option .flex {
            align-items: flex-start;
        }
        
        .market-option .market-icon {
            margin-top: 2px;
        }
<style>
    html {
  scroll-behavior: smooth;
}

        :root {
            --neon-blue: #00f3ff;
            --neon-purple: #9d00ff;
            --neon-pink: #ff00f7;
            --neon-green: #00ff7f;
            --neon-yellow: #ffee00;
            --dark-bg: #050714;
            --darker-bg: #030410;
        }
        
        body {
            background-color: var(--dark-bg);
            color: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }
        
        .bg-gradient {
            background: linear-gradient(135deg, var(--darker-bg) 0%, #0a0a2e 100%);
        }
        
        .text-gradient {
            background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .neon-border {
            border: 1px solid transparent;
            border-image: linear-gradient(90deg, var(--neon-blue), var(--neon-purple));
            border-image-slice: 1;
            box-shadow: 0 0 15px rgba(0, 243, 255, 0.5);
        }
        
        .neon-button {
            background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple));
            color: white;
            border: none;
            position: relative;
            z-index: 1;
            overflow: hidden;
            transition: 0.3s;
        }
        
        .neon-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 20px rgba(157, 0, 255, 0.7);
        }
        
        .neon-button::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, var(--neon-purple), var(--neon-blue));
            z-index: -1;
            opacity: 0;
            transition: 0.3s;
        }
        
        .neon-button:hover::after {
            opacity: 1;
        }
        
        .robot-bg {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxkZWZzPjxsaW5lYXJHcmFkaWVudCBpZD0iZ3JhZCIgeDI9IjAlIiB5Mj0iMTAwJSI+PHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzAwZjNmZiIgc3RvcC1vcGFjaXR5PSIwLjEiLz48c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiM5ZDAwZmYiIHN0b3Atb3BhY2l0eT0iMC4wNSIvPjwvbGluZWFyR3JhZGllbnQ+PC9kZWZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JhZCkiLz48L3N2Zz4=');
            opacity: 0.2;
            z-index: -1;
        }
        
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        
        .glow {
            filter: drop-shadow(0 0 10px var(--neon-blue));
        }
        
        .iti {
            width: 100%;
        }
        
        .iti__flag-container {
            z-index: 10;
        }
        
        /* Custom slider styling */
        .slider {
            -webkit-appearance: none;
            width: 100%;
            height: 8px;
            border-radius: 5px;
            background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple));
            outline: none;
        }
        
        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: white;
            cursor: pointer;
            box-shadow: 0 0 15px rgba(157, 0, 255, 0.7);
        }
        
        .slider::-moz-range-thumb {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: white;
            cursor: pointer;
            box-shadow: 0 0 15px rgba(157, 0, 255, 0.7);
        }
        
        /* Grid background */
        .grid-bg {
            background-image: 
                linear-gradient(rgba(5, 7, 20, 0.9) 1px, transparent 1px),
                linear-gradient(90deg, rgba(5, 7, 20, 0.9) 1px, transparent 1px);
            background-size: 20px 20px;
            background-position: center center;
        }
        
        /* Pulse animation for CTA */
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(0, 243, 255, 0.7);
            }
            
            70% {
                transform: scale(1.05);
                box-shadow: 0 0 0 10px rgba(0, 243, 255, 0);
            }
            
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(0, 243, 255, 0);
            }
        }
        
        /* Consultant button */
        .consultant-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 100;
            background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple));
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 20px rgba(157, 0, 255, 0.7);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .consultant-button:hover {
            transform: scale(1.1);
        }
        
        /* Trade animation */
        .trade-card {
            background: rgba(0, 0, 0, 0.7);
            border: 1px solid var(--neon-blue);
            border-radius: 10px;
            padding: 15px;
            width: 250px;
            box-shadow: 0 0 20px rgba(0, 243, 255, 0.3);
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }
        
        .trade-card.active {
            opacity: 1;
            transform: translateY(0);
        }
        
        .trade-card.buy {
            border-color: var(--neon-green);
            box-shadow: 0 0 20px rgba(0, 255, 127, 0.3);
        }
        
        .trade-card.sell {
            border-color: #70ff00;
            box-shadow: 0 0 20px rgba(255, 0, 247, 0.3);
        }
        
        /* Chart animation */
        @keyframes drawLine {
            to {
                stroke-dashoffset: 0;
            }
        }
        
        /* Chart tabs */
        .chart-tab {
            padding: 8px 16px;
            border-radius: 8px 8px 0 0;
            background: rgba(0, 0, 0, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
            border-bottom: 2px solid transparent;
        }
        
        .chart-tab.active {
            background: rgba(0, 0, 0, 0.5);
            border-bottom: 2px solid var(--neon-blue);
        }
        
        /* Chart container */
        .chart-container {
            position: relative;
            width: 100%;
            height: 100%;
            border-radius: 10px;
            overflow: hidden;
            background: rgba(0, 0, 0, 0.2);
        }
        
        .chart-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 10;
            background: linear-gradient(to bottom, rgba(0,0,0,0) 80%, rgba(0,0,0,0.8) 100%);
        }
        
        .chart-controls {
            position: absolute;
            bottom: 10px;
            right: 10px;
            z-index: 20;
            display: flex;
            gap: 5px;
        }
        
        .chart-control-btn {
            background: rgba(0, 0, 0, 0.6);
            border: 1px solid var(--neon-blue);
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .chart-control-btn:hover {
            background: rgba(0, 243, 255, 0.2);
        }
        
        /* Trading showcase */
        .trading-showcase {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        
        .showcase-tab {
            padding: 8px 16px;
            border-radius: 8px 8px 0 0;
            background: rgba(0, 0, 0, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
            border-bottom: 2px solid transparent;
        }
        
        .showcase-tab.active {
            background: rgba(0, 0, 0, 0.5);
            border-bottom: 2px solid var(--neon-blue);
        }
        
        .showcase-content {
            display: none;
            height: 100%;
        }
        
        .showcase-content.active {
            display: block;
        }
        
        .insight-card {
            background: rgba(0, 0, 0, 0.7);
            border: 1px solid var(--neon-blue);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
            box-shadow: 0 0 10px rgba(0, 243, 255, 0.2);
            transition: all 0.3s ease;
        }
        
        .insight-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 15px rgba(0, 243, 255, 0.4);
        }
        
        /* Mobile optimizations */
        @media (max-width: 768px) {
            .consultant-button {
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
            }
            
            .trade-card {
                width: 200px;
                padding: 10px;
                font-size: 0.9em;
            }
            
            .chart-tab, .showcase-tab {
                padding: 6px 10px;
                font-size: 0.8em;
            }
            
            .chart-controls {
                bottom: 5px;
                right: 5px;
            }
            
            .chart-control-btn {
                width: 25px;
                height: 25px;
            }
        }
    </style>
      <style>
    .trustpilot-widget {
      font-family: Arial, sans-serif;
      display: flex;
      align-items: center;
      gap: 5px;
      padding: 3px 10px;
      border: 1px solid #00b67a;
      border-radius: 8px;
      background-color: #1a1d34;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      max-width: 200px;
    }

    .trustpilot-logo {
      display: flex;
      flex-direction: column;
      font-size: 14px;
      color: #333;
    }

    .trustpilot-logo span:first-child {
      font-weight: bold;
      color: #00b67a;
      font-size: 16px;

    }

    .trustpilot-rating {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }

    .trustpilot-stars {
      display: flex;
    }

    .star {
      color: #00b67a;
      font-size: 16px;
      margin-right: 1px;
    }

    .star.gray {
      color: #ccc;
    }

    .trustpilot-score {
      font-size: 13px;
      color: white;
    }

    .trustpilot-score span {
      font-weight: bold;
    }

     .verified-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 10px;
      background-color: #eafaf3;
      border: 1px solid #00b67a;
      color: #00b67a;
      font-size: 12px;
      font-weight: 600;
      border-radius: 6px;
      max-width: fit-content;
    }

    .verified-badge svg {
      width: 14px;
      height: 14px;
    }


.impulso-banner {
  font-family: 'Anton', sans-serif;
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  text-align: center;
  font-size: 25vw;
  color: rgba(255, 255, 255, 0.1);
  pointer-events: none;
  z-index: 9999999;
  font-weight: normal; /* Anton уже жирный по умолчанию */
  text-transform: uppercase;
  letter-spacing: 2px;
}

.font-anton {
      font-family: 'Anton', sans-serif;
}

.iti__country.iti__highlight {
background-color: #212936;
}

.iti__country-list {
    border:  none;
}
  </style>

    
   
    <link rel="icon" type="image/png" href="images/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/svg+xml" href="images/favicon.svg">
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <!-- SVG Animation -->
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
<script src="https://unpkg.com/lucide@latest"></script>
<style>
/* Адаптация торговых уведомлений для мобильных устройств */
@media (max-width: 768px) {
  /* Контейнер для уведомлений */
  .live-trades-container {
    position: fixed !important;
    bottom: 70px !important; /* Отступ от нижнего края экрана */
    right: 10px !important;
    left: 10px !important;
    width: auto !important;
    max-width: 100% !important;
    max-height: 40% !important;
    overflow-y: auto !important;
    z-index: 9999 !important;
    padding-bottom: 5px !important;
    pointer-events: auto !important;
  }
  
  /* Стили для карточек уведомлений */
  .trade-card {
    width: 100% !important;
    max-width: 100% !important;
    margin-bottom: 8px !important;
    padding: 12px !important;
    border-radius: 10px !important;
    background-color: rgba(30, 41, 59, 0.95) !important;
    backdrop-filter: blur(4px) !important;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
    border-left-width: 4px !important;
    transform: none !important;
    opacity: 1 !important;
    transition: all 0.3s ease !important;
  }
  
  /* Анимация появления */
  .trade-card.active {
    animation: slideInUp 0.3s ease forwards !important;
  }
  
  /* Стили для карточек продажи */
  .trade-card.sell {
    border-left-color: #10b981 !important;
  }
  
  /* Стили для карточек покупки */
  .trade-card.buy {
    border-left-color: #6b7280 !important;
  }
  
  /* Стили для текста внутри карточек */
  .trade-card .font-bold {
    font-size: 16px !important;
    font-weight: 700 !important;
  }
  
  .trade-card .text-sm {
    font-size: 13px !important;
  }
  
  .trade-card .text-xs {
    font-size: 11px !important;
  }
  
  /* Стили для бейджа типа операции */
  .trade-card .rounded-full {
    padding: 2px 6px !important;
    border-radius: 12px !important;
    font-size: 10px !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
  }
  
  /* Стили для значения прибыли */
  .trade-card .text-green-500 {
    font-size: 18px !important;
    font-weight: 700 !important;
  }
  
  /* Анимация появления снизу */
  @keyframes slideInUp {
    from {
      transform: translateY(20px);
      opacity: 0;
    }
    to {
      transform: translateY(0);
      opacity: 1;
    }
  }
  
  /* Стиль для пустого контейнера */
  .live-trades-container .bg-slate-800 {
    padding: 10px !important;
    text-align: center !important;
    border-radius: 10px !important;
    font-size: 13px !important;
  }
  
  /* Ограничиваем количество одновременно видимых уведомлений */
  .live-trades-container .trade-card:nth-child(n+4) {
    display: none !important;
  }
}
.iti__country.iti__highlight {
background-color: #212936;
}
.iti__country-list {
	border:  none;
}

</style>
<style>
        .legal-popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }
        
        .legal-popup-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .legal-popup {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #fff;
            width: 90%;
            max-width: 900px;
            max-height: 85vh;
            border-radius: 12px;
            box-shadow: 0 0 30px rgba(0, 163, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        
        .legal-popup-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            background: inherit;
            z-index: 1;
        }
        
        .legal-popup-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #00a3ff;
            margin: 0;
        }
        
        .legal-popup-close {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s;
        }
        
        .legal-popup-close:hover {
            color: #fff;
        }
        
        .legal-popup-content {
            padding: 1.5rem;
            overflow-y: auto;
            flex-grow: 1;
        }
        
        .legal-popup-content h2 {
            color: #00a3ff;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            font-size: 1.25rem;
            font-weight: 600;
        }
        
        .legal-popup-content h3 {
            color: #fff;
            margin-top: 1.25rem;
            margin-bottom: 0.75rem;
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .legal-popup-content p {
            margin-bottom: 1rem;
            line-height: 1.6;
        }
        
        .legal-popup-content ul {
            margin-left: 1.5rem;
            margin-bottom: 1rem;
            list-style-type: disc;
        }
        
        .legal-popup-content li {
            margin-bottom: 0.5rem;
            line-height: 1.6;
        }
        
        .legal-popup-content a {
            color: #00a3ff;
            text-decoration: none;
            transition: text-decoration 0.2s;
        }
        
        .legal-popup-content a:hover {
            text-decoration: underline;
        }
        
        .legal-popup-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.6);
            background: inherit;
        }
        
        .legal-popup-section {
            margin-bottom: 1.5rem;
        }
        
        .legal-popup-alert {
            background-color: rgba(255, 59, 48, 0.1);
            border-left: 4px solid rgba(255, 59, 48, 0.7);
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.25rem;
        }
        
        .legal-popup-company-info {
            background-color: rgba(0, 163, 255, 0.1);
            border: 1px solid rgba(0, 163, 255, 0.2);
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .legal-popup-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }
        
        .legal-popup-table th {
            background-color: rgba(0, 163, 255, 0.1);
            text-align: left;
            padding: 0.75rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .legal-popup-table td {
            padding: 0.75rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .legal-popup-table tr:last-child td {
            border-bottom: none;
        }
        
        /* Estilos para links que abrem os popups */
        .legal-popup-link {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.2s;
            cursor: pointer;
        }
        
        .legal-popup-link:hover {
            color: #fff;
            text-decoration: underline;
        }
        
        /* Desativar scroll do body quando popup está aberto */
        body.popup-open {
            overflow: hidden;
        }
        
        /* Responsividade para dispositivos móveis */
        @media (max-width: 768px) {
            .legal-popup {
                width: 95%;
                max-height: 90vh;
            }
            
            .legal-popup-header {
                padding: 1rem;
            }
            
            .legal-popup-content {
                padding: 1rem;
            }
            
            .legal-popup-title {
                font-size: 1.25rem;
            }
        }
    </style>
<meta name="google" content="notranslate">
</head>
<body class="min-h-screen bg-slate-900">
<div id="superStickyHeader" class="hidden fixed top-0 left-0 right-0 z-[9999] bg-gradient-to-b from-black/70 via-black/60 to-black/40 backdrop-blur-lg border-b border-white/10 px-6 py-3">
  <div class="flex items-center">
    <button onclick="history.back()" class="text-xs text-white border border-white px-4 py-1 rounded-full hover:bg-white hover:text-black transition font-semibold">
        Back
      </button>
  </div>
</div>


    <!-- Welcome Modal -->
<div id="welcomeModal" class="welcome-modal flex justify-center items-center p-4">
    <div class="welcome-content relative w-full max-w-lg bg-slate-900 rounded-xl p-6 text-center overflow-hidden">
        
        <!-- Анимация фоном, с вылетом за угол -->
        <div class="absolute -top-10 -right-30 w-[120%] h-60 opacity-70 pointer-events-none z-0">
            <dotlottie-player src="https://lottie.host/dc7e66ee-62ee-462c-8574-e02afd23e741/v4VEFM6HBy.lottie" background="transparent.html" speed="1" style="width: 100%; height: 100%; object-fit: cover" loop="" autoplay=""></dotlottie-player>
        </div>

        <!-- Контент -->
<i data-lucide="bot" class="w-20 h-20 mx-auto mb-4 text-blue-500"></i>
<h2 class="relative z-10 text-xl sm:text-2xl font-bold mb-4">Welcome to the <br> <span class="text-gradient">Trading Bot</span> Demo</h2>
<p class="relative z-10 text-gray-300 mb-6 text-sm sm:text-base">
  This is a demonstration that shows how an automated trading bot works. No real money is used and no real trades are executed.
</p>

<div class="relative z-10 bg-slate-800 p-4 rounded-md mb-6 text-left text-sm sm:text-base">
  <h3 class="font-bold mb-2">What you'll learn:</h3>
    <ul class="list-disc pl-5 space-y-1 text-gray-300">
    <li>How to set up a trading bot</li>
    <li>How to choose markets and strategies</li>
    <li>How to monitor the bot's performance</li>
    <li>How the bot executes trades automatically</li>
    </ul>
</div>
<p class="relative z-10 text-gray-400 mb-6 text-sm sm:text-base">
  Let's start with a quick tutorial that shows how everything works.
</p>

<button id="startDemoBtn" class="relative z-10 py-3 px-6 sm:px-8 rounded-md btn-primary font-medium w-full sm:w-auto">
  Start Demo
</button>
    </div>
</div>


    <div class="container mx-auto px-4 py-8">
       <!-- Header -->
<header class="flex flex-col gap-6 md:flex-row md:justify-between md:items-center mb-8 px-4" data-intro="Welcome to the Trading Bot Demo! This is your dashboard where you can monitor trading activity and performance." data-step="1">
    
    <!-- Logo -->
    <div class="flex items-center justify-center md:justify-start">

            <!--?xml version="1.0" standalone="no"?-->
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 1024.000000 1024.000000" preserveAspectRatio="xMidYMid meet">

                <g transform="translate(0.000000,1024.000000) scale(0.100000,-0.100000)" fill="#ffffff" stroke="none">
                <path d="M710 5693 c0 -617 2 -742 16 -818 41 -233 142 -423 314 -589 253
                -244 565 -344 910 -291 284 43 532 191 703 420 53 71 135 224 151 280 5 16
                -27 53 -154 180 -153 152 -160 158 -160 128 0 -47 -56 -199 -102 -276 -73
                -121 -182 -223 -302 -282 -186 -91 -435 -87 -633 10 -148 73 -291 244 -351
                420 l-27 80 -3 505 -3 504 358 -363 358 -364 344 352 c190 193 348 351 353
                351 4 0 8 -125 8 -278 l0 -277 190 -190 190 -190 0 708 0 707 -194 0 -194 0
                -97 -102 c-54 -57 -211 -219 -350 -360 l-251 -258 -350 360 -349 359 -187 1
                -188 0 0 -727z"></path>
                <path d="M5227 6120 c-305 -77 -412 -483 -186 -709 154 -153 409 -163 564 -20
                40 37 122 175 110 187 -2 2 -36 4 -77 5 l-73 2 -26 -41 c-46 -71 -112 -104
                -208 -104 -174 1 -287 183 -232 375 21 73 98 148 169 165 29 7 72 9 95 6 62
                -9 138 -57 167 -105 l25 -40 78 -1 c55 0 77 4 77 13 0 30 -61 136 -101 174
                -69 66 -144 95 -253 99 -50 2 -108 -1 -129 -6z"></path>
                <path d="M6950 6116 c-140 -40 -238 -136 -280 -274 -94 -303 153 -594 461
                -543 303 50 445 395 271 660 -40 60 -92 102 -172 139 -67 30 -208 39 -280 18z
                m186 -141 c177 -53 243 -306 116 -447 -131 -145 -353 -103 -423 80 -55 146 19
                318 157 367 51 18 89 18 150 0z"></path>
                <path d="M3528 5710 l-3 -400 78 0 77 0 0 268 0 267 43 -95 c60 -132 173 -379
                189 -413 10 -21 19 -27 38 -25 22 3 34 24 105 183 44 99 96 216 115 260 19 44
                36 83 40 87 3 4 4 -114 2 -262 l-3 -270 81 0 80 0 0 400 0 400 -88 0 -88 0
                -117 -250 c-64 -137 -117 -254 -117 -260 0 -33 -28 17 -136 248 l-122 257 -86
                3 -86 3 -2 -401z"></path>
                <path d="M4580 5710 l0 -400 80 0 80 0 0 400 0 400 -80 0 -80 0 0 -400z"></path>
                <path d="M5880 5710 l0 -400 80 0 80 0 0 145 0 145 73 0 72 0 75 -145 75 -145
                92 0 91 0 -88 157 -89 157 50 28 c109 63 149 210 89 328 -26 52 -54 77 -115
                106 -48 23 -60 24 -267 24 l-218 0 0 -400z m402 251 c58 -22 81 -115 41 -169
                -35 -48 -78 -62 -185 -62 l-98 0 0 118 c0 65 2 121 4 123 9 8 212 0 238 -10z"></path>
                <path d="M7640 5710 l0 -400 82 0 81 0 -6 277 c-3 152 -2 272 2 267 4 -5 86
                -119 181 -254 96 -135 183 -255 194 -267 17 -20 30 -23 88 -23 l68 0 0 400 0
                400 -77 0 -78 0 3 -272 4 -273 -56 80 c-31 44 -118 166 -193 270 l-138 190
                -78 3 -77 3 0 -401z"></path>
                <path d="M8476 6098 c5 -7 58 -92 118 -188 60 -96 125 -199 143 -229 l33 -55
                0 -158 0 -158 80 0 80 0 0 158 0 158 148 239 148 240 -90 3 c-50 2 -92 -1 -93
                -5 -2 -4 -44 -78 -93 -163 -49 -85 -92 -159 -95 -165 -3 -7 -7 -7 -10 0 -3 6
                -48 83 -101 173 l-96 162 -90 0 c-69 0 -87 -3 -82 -12z"></path>
                <path d="M9335 6099 c4 -6 63 -91 131 -190 68 -100 124 -183 124 -185 0 -2
                -24 -37 -54 -77 -53 -72 -215 -301 -230 -324 -5 -10 14 -13 86 -13 l93 0 94
                145 c52 80 98 145 102 145 4 0 48 -65 99 -145 l91 -145 94 0 94 0 -145 211
                -144 211 128 179 c70 98 129 184 130 189 3 7 -27 10 -84 8 l-87 -3 -83 -119
                c-46 -66 -87 -123 -92 -128 -4 -4 -46 50 -92 122 l-83 130 -89 0 c-61 0 -87
                -3 -83 -11z"></path>
                <path d="M3780 4990 c-6 -11 -52 -127 -101 -258 -85 -224 -148 -388 -190 -494
                l-19 -48 83 0 82 0 35 95 34 95 161 0 160 0 23 -67 c47 -136 34 -123 123 -123
                46 0 79 4 79 10 0 9 -117 320 -202 540 -16 41 -45 119 -65 173 l-36 97 -78 0
                c-68 0 -80 -3 -89 -20z m148 -322 c29 -80 52 -149 52 -152 0 -3 -52 -6 -116
                -6 -64 0 -114 4 -112 8 2 5 27 77 57 160 30 84 58 149 61 145 4 -5 30 -74 58
                -155z"></path>
                <path d="M4390 4600 l0 -410 75 0 75 0 0 410 0 410 -75 0 -75 0 0 -410z"></path>
                </g>
                </svg>

    </div>

    <!-- Button -->
    <div class="flex justify-center md:justify-start">
        <a href="#registro" style="padding: 20px;" id="full_access" class="flex items-center justify-center gap-2 neon-button px-6 py-2 text-sm rounded-full font-semibold">
          <!-- Raketen-Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="rocket" class="lucide lucide-rocket w-4 h-4">
            <path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"></path>
            <path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"></path>
            <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"></path>
            <path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"></path>
          </svg>
          Get Full Access
        </a>
      </div>
    
    <!-- Información de la cuenta -->
    <div class="flex flex-col items-center md:flex-row md:items-center md:space-x-4 gap-2">
        <div class="text-center md:text-right">
          <p class="text-sm text-gray-400">Current DEMO Balance</p>
          <p class="text-xl font-bold text-white">₣ <span id="balance">0.00</span></p>
        </div>
        <div>
          <p style="color: red;">DEMO</p>
        </div>
        <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
          D
        </div>
      </div>

</header>

        
        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Left Column - Settings -->
            <div class="card p-6" data-intro="Here you can configure your trading bot settings, including deposit, markets, and strategy." data-step="2">
                <h2 class="text-xl font-bold mb-4">Trading Settings</h2>

                <!-- Einzahlung-/Auszahlungs-Buttons -->
                <div class="flex space-x-2 mb-6" data-intro="You need to deposit funds to start trading. Click the Deposit button to add funds to your account." data-step="3">
                    <button id="depositBtn" class="flex-1 py-2 rounded-md btn-primary font-medium pulse">
                        Deposit
                    </button>
                    <button id="withdrawBtn" class="flex-1 py-2 rounded-md btn-neutral font-medium">
                        Withdraw
                    </button>
                </div>

                <!-- Market Selection -->
                <div class="mb-6" data-intro="Select the markets you want to trade. You can choose multiple." data-step="4">
                    <label class="block text-sm font-medium text-gray-400 mb-2">Select Markets</label>
                    <div class="grid grid-cols-2 gap-3">
                      <div class="market-option selected p-3 rounded-md bg-slate-800" data-market="forex">
                        <div class="flex items-center">
                          <div class="market-icon text-blue-500 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.736 6.979C9.208 6.193 9.696 6 10 6c.304 0 .792.193 1.264.979a1 1 0 001.715-1.029C12.279 4.784 11.232 4 10 4s-2.279.784-2.979 1.95a1 1 0 001.715 1.029zM6 10a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zM7.264 14.021C6.792 14.807 6.304 15 6 15c-.304 0-.792-.193-1.264-.979a1 1 0 00-1.715 1.029C3.721 16.216 4.768 17 6 17s2.279-.784 2.979-1.95a1 1 0 00-1.715-1.029z" clip-rule="evenodd"></path>
                            </svg>
                          </div>
                          <span>Forex</span>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Pairs</p>
                      </div>
                      <div class="market-option p-3 rounded-md bg-slate-800" data-market="stocks">
                        <div class="flex items-center">
                          <div class="market-icon text-green-500 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                            </svg>
                          </div>
                          <span>Stocks</span>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Equities</p>
                      </div>
                      <div class="market-option p-3 rounded-md bg-slate-800" data-market="crypto">
                        <div class="flex items-center">
                          <div class="market-icon text-yellow-500 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                              <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z"></path>
                            </svg>
                          </div>
                          <span>Crypto</span>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Digital currencies</p>
                      </div>
                      <div class="market-option p-3 rounded-md bg-slate-800" data-market="commodities">
                        <div class="flex items-center">
                          <div class="market-icon text-yellow-600 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z" clip-rule="evenodd"></path>
                            </svg>
                          </div>
                          <span>Commodities</span>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Gold, Oil, Metals</p>
                      </div>
                    </div>
                  </div>
                
                <!-- Trading Strategy -->
                <div class="mb-6" data-intro="Choose your trading strategy. This affects how the bot manages your funds." data-step="5">
                    <label class="block text-sm font-medium text-gray-400 mb-2">Trading Strategy</label>
                    <select id="strategySelect" class="w-full bg-slate-800 border border-slate-700 rounded-md py-2 px-3 text-white">
                      <option value="conservative" data-min="250" data-max="1000">Conservative</option>
                      <option value="balanced" data-min="1000" data-max="5000">Balanced</option>
                      <option value="aggressive" data-min="5000" data-max="50000">Aggressive</option>
                    </select>
                  </div>
                
                <!-- Start Trading Button -->
        <button id="startTradingBtn" class="w-full py-3 rounded-md btn-primary font-medium super-highlight" data-intro="Click this button to start the trading bot. It will begin trading based on your settings." data-step="6">
          Start Trading Bot
                  </button>
                  <!-- Bot-Status -->
                  <div id="botStatus" class="mt-4 hidden">
                    <div class="flex items-center justify-between p-3 bg-slate-800 rounded-md">
                      <div class="flex items-center">
                        <div class="h-3 w-3 rounded-full bg-green-500 mr-2 animate-pulse"></div>
                        <span class="text-sm">Bot running</span>
                      </div>
                      <button id="pauseBotBtn" class="text-xs text-neutral hover:text-neutral-400">Pause</button>
                    </div>
                  </div>
            </div>
            
            <!-- Central Column - Chart -->
            <div class="card p-6 lg:col-span-3 relative" data-intro="This is the live trading chart where you can monitor your balance growth and trading activity." data-step="7">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">Balance Chart</h2>
                  </div>
                
                  <div class="relative h-96 chart-container">
                    <div class="chart-grid"></div>
                    <canvas id="tradingChart"></canvas>
                    <div id="tradeMarkers"></div>
                  
                    <!-- No Balance Overlay -->
                    <div id="noBalanceOverlay" class="no-balance-overlay">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                      <p class="text-lg font-medium">You need to deposit funds to start</p>
                      <p class="text-sm text-gray-400 mt-2 mb-4">Click the "Deposit" button to add funds</p>
                      <button id="depositBtnOverlay" class="py-2 px-6 rounded-md btn-primary font-medium">
                        Deposit now
                      </button>
                    </div>
                  
                    <div id="chartOverlay" class="absolute inset-0 flex items-center justify-center bg-slate-900 bg-opacity-80 z-10 hidden">
                      <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <p class="text-lg font-medium">Start the trading bot to view the live chart</p>
                        <p class="text-sm text-gray-400 mt-2">Set your preferences and click "Start Trading Bot"</p>
                      </div>
                    </div>
                  
                    <!-- Live Trades Container -->
                    <div id="liveTradesContainer" class="live-trades-container hidden" data-intro="Here you can see live trade notifications as they happen." data-step="8">
                      <!-- Live trades will be added here -->
                    </div>
                  
                    <!-- Balance Chart -->
                    <div id="balanceDisplay" class="balance-chart hidden">
                      <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium">Total Balance</span>
                        <span class="text-lg font-bold">₣ <span id="currentBalance">0.00</span></span>
                      </div>
                      <div class="flex items-center">
                        <span class="text-xs text-gray-400">Profit:</span>
                        <span id="profitIndicator" class="text-sm ml-2 profit">+₣ 0.00</span>
                      </div>
                    </div>
                  </div>
                
                <!-- Trading Statistics -->
                <div class="grid grid-cols-4 gap-4 mt-6" data-intro="These statistics show your trading performance, including total trades, win rate, and profits." data-step="9">
                    <div class="bg-slate-800 p-3 rounded-md">
                      <p class="text-sm text-gray-400">Total Trades</p>
                      <p class="text-xl font-bold"><span id="totalTrades">0</span></p>
                    </div>
                    <div class="bg-slate-800 p-3 rounded-md">
                      <p class="text-sm text-gray-400">Win Rate</p>
                      <p class="text-xl font-bold"><span id="winRate">0</span>%</p>
                    </div>
                    <div class="bg-slate-800 p-3 rounded-md">
                      <p class="text-sm text-gray-400">Profit Today</p>
                      <p class="text-xl font-bold">₣<span id="profitToday">0.00</span></p>
                    </div>
                    <div class="bg-slate-800 p-3 rounded-md">
                      <p class="text-sm text-gray-400">Total Profit</p>
                      <p class="text-xl font-bold">₣<span id="totalProfit">0.00</span></p>
                    </div>
                  </div>
            </div>
            
            <!-- Trade History -->
      <div class="card p-6 lg:col-span-4" data-intro="This table shows your most recent trades with details for each transaction." data-step="10">
        <h2 class="text-xl font-bold mb-4">Latest Trades</h2>
                
                <div class="overflow-x-auto">
                  <table class="min-w-full">
                    <thead>
                      <tr class="border-b border-slate-700">
                        <th class="py-3 text-left text-sm font-medium text-gray-400">Time</th>
                        <th class="py-3 text-left text-sm font-medium text-gray-400">Asset</th>
                        <th class="py-3 text-left text-sm font-medium text-gray-400">Type</th>
                        <th class="py-3 text-left text-sm font-medium text-gray-400">Entry</th>
                        <th class="py-3 text-left text-sm font-medium text-gray-400">Exit</th>
                        <th class="py-3 text-left text-sm font-medium text-gray-400">Amount</th>
                        <th class="py-3 text-right text-sm font-medium text-gray-400">Profit/Loss</th>
                      </tr>
                    </thead>
                    <tbody id="tradeHistory">
                      <!-- Dini Trade-Historie wird da angezeigt -->
                      <tr class="border-b border-slate-800">
                        <td class="py-4 text-sm" colspan="7">No trades yet. Start the trading bot to see activity.</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
        </div>

        
        <!-- Footer -->
        <footer class="mt-8 text-center text-sm text-gray-500">
            <p>Micronyx AI Ltd.© 2025 <br><span style="color: red;">Trading Bot Demo.</span> <br>This is a simulation for demonstration purposes only.</p>
            <p class="mt-1">No real money is used and no real trades are executed.</p>
            <div class="legal-links flex flex-wrap space-x-4 justify-center mt-4">
              <a href="#" class="legal-popup-link text-sm" data-popup="termos-uso-popup">Terms of Use</a>
              <a href="#" class="legal-popup-link text-sm" data-popup="privacidade-popup">Privacy Policy</a>
              <a href="#" class="legal-popup-link text-sm" data-popup="cookies-popup">Cookie Policy</a>
              <a href="#" class="legal-popup-link text-sm" data-popup="risco-popup">Risk Disclosure</a>
            </div>
          </footer>
    </div>
    
    <!-- Deposit Modal -->
    <div id="depositModal" class="modal">
        <div class="modal-content">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-xl font-bold">Deposit Funds <span style="color: red;">[Demo]</span></h2>
              <button class="close-modal text-gray-400 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
              </button>
            </div>
            <p class="text-gray-400 mb-4">Choose the amount you want to deposit into your trading account.</p>
          
            <div class="mb-6">
              <label class="block text-sm font-medium text-gray-400 mb-2">Deposit Amount (250 - ₣ 50,000)</label>
              <div class="flex items-center space-x-4">
                <input type="range" id="depositSlider" min="250" max="50000" step="250" value="250" class="flex-1">
                <div class="relative">
                  <span class="absolute text-gray-500 left-3 top-2">₣</span>
                  <input type="number" id="depositInput" value="250" min="250" max="50000" class="bg-slate-800 border border-slate-700 rounded-md py-1 pl-8 pr-3 text-white w-32">
                </div>
              </div>
            </div>
          
            <div class="grid grid-cols-3 gap-3 mb-6">
              <button class="deposit-preset py-2 rounded-md btn-neutral" data-amount="250">₣ 250</button>
              <button class="deposit-preset py-2 rounded-md btn-neutral" data-amount="1000">₣ 1’000</button>
              <button class="deposit-preset py-2 rounded-md btn-neutral" data-amount="5000">₣ 5’000</button>
            </div>
          
            <button id="confirmDepositBtn" class="w-full py-3 rounded-md btn-primary font-medium">
              Confirm Deposit
            </button>
          </div>
    </div>
    

<!-- Chat Box -->
<div id="chatBox" class="fixed bottom-24 right-4 w-80 z-50 hidden animate-slide-up">
    <div class="relative overflow-hidden shadow-xl border border-[#2e374d] backdrop-blur-md bg-[#21293bcc]" style="clip-path: inset(0% round 28px);">
      
      <!-- Заголовок чата -->
      <div class="px-4 py-3 bg-gradient-to-r from-[#8d2cf6] to-[#71e1fc] text-white text-base font-semibold shadow-inner shadow-[#00000033]">
       
  <p class="text-sm"> <i data-lucide="phone" class="w-4 h-4 mr-2 inline-block"></i> Get full access</p>
      </div>
  
      <!-- Форма -->
      <form action="thanks/index.php" method="POST" id="registrationForm3" class="p-4 space-y-4 text-sm">
        <input name="f_name" type="text" placeholder="First name" class="text-base w-full bg-[#1b2232] border border-[#2e374d] text-white placeholder-gray-400 px-3 py-2 rounded-[0.75rem] focus:ring-2 focus:ring-[#71e1fc] focus:outline-none" required="">
      
        <input name="l_name" type="text" placeholder="Last name" class="text-base w-full bg-[#1b2232] border border-[#2e374d] text-white placeholder-gray-400 px-3 py-2 rounded-[0.75rem] focus:ring-2 focus:ring-[#71e1fc] focus:outline-none" required="">
      
        <input name="email" type="email" placeholder="Email address" class="text-base w-full bg-[#1b2232] border border-[#2e374d] text-white placeholder-gray-400 px-3 py-2 rounded-[0.75rem] focus:ring-2 focus:ring-[#71e1fc] focus:outline-none" required="">
      
        <input type="tel" placeholder="Phone" name="phone" class="text-base w-full bg-[#1b2232] border border-[#2e374d] text-white placeholder-gray-400 px-3 py-2 rounded-[0.75rem] focus:ring-2 focus:ring-[#71e1fc] focus:outline-none" required="">
      
        <input type="hidden" name="phone2" class="phone2" autocomplete="on" required="">
<input type="hidden" name="pixel_id" value="n">
<input type="hidden" name="page_lang" value="de">
<input type="hidden" name="query" value="m=n">
<input type="hidden" name="gp_id" value="">
<input type="hidden" name="hs_id" value="">
<input type="hidden" name="countryCode" id="countryCode" value="NL">
<input type="hidden" name="ip" id="ip" value="2a00:b703:fff1:102::1">
<input type="hidden" name="fbclid" value="">
<input type="hidden" name="landing" value="MycronyxAI-CH">
      
        <button type="submit" class="text-base w-full bg-[#71e1fc] hover:bg-[#63cde8] text-[#21293b] font-semibold py-2 rounded-[0.75rem] transition">
          <i data-lucide="rocket" class="inline-block w-4 h-4"></i>
          Get started
        </button>
      </form>
    </div>
  </div>
  
  
  <!-- Consultant Button (как было) -->
  <div class="pulse consultant-button pulse fixed bottom-4 right-4 z-50 bg-[#8d2cf6] text-white p-4 rounded-full shadow-lg cursor-pointer" onclick="toggleChat()" id="chatToggle">
    <!-- Open Icon -->
    <svg id="chatIconOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
    </svg>
    <!-- Close Icon -->
    <svg id="chatIconClose" xmlns="http://www.w3.org/2000/svg" class=" w-6 h-6 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <line x1="18" y1="6" x2="6" y2="18"></line>
      <line x1="6" y1="6" x2="18" y2="18"></line>
    </svg>
  </div>
  
  <!-- Script -->
  <script>
    function toggleChat() {
      const chatBox = document.getElementById('chatBox');
      const iconOpen = document.getElementById('chatIconOpen');
      const iconClose = document.getElementById('chatIconClose');
  
      chatBox.classList.toggle('hidden');
      iconOpen.classList.toggle('hidden');
      iconClose.classList.toggle('hidden');
    }
  </script>
  
    
    <!-- Withdraw Modal -->
    <div id="withdrawModal" class="modal">
        <div class="modal-content">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Withdraw Funds</h2>
            <button class="close-modal text-gray-400 hover:text-white">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>
          <p class="text-gray-400 mb-4">Choose the amount and method to withdraw from your trading account.</p>
      
          <div class="mb-6">
            <label class="block text-sm font-medium text-gray-400 mb-2">Withdrawal Amount</label>
            <div class="relative">
              <span class="absolute text-gray-500 left-3 top-2">₣</span>
              <input type="number" id="withdrawInput" value="100" min="50" class="bg-slate-800 border border-slate-700 rounded-md py-1 pl-8 pr-3 text-white w-full">
            </div>
            <p class="text-sm text-gray-400 mt-1">Available: ₣<span id="availableBalance">0.00</span></p>
          </div>
      
          <div class="mb-6">
            <label class="block text-sm font-medium text-gray-400 mb-2">Withdrawal Method</label>
            <div class="grid grid-cols-2 gap-3">
              <div class="withdraw-method selected p-3 rounded-md bg-slate-800" data-method="paypal">
                <div class="flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                  </svg>
                  <span>PayPal</span>
                </div>
              </div>
              <div class="withdraw-method p-3 rounded-md bg-slate-800" data-method="iban">
                <div class="flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.496 2.132a1 1 0 00-.992 0l-7 4A1 1 0 003 8v7a1 1 0 100 2h14a1 1 0 100-2V8a1 1 0 00.496-1.868l-7-4zM6 9a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1zm3 1a1 1 0 012 0v3a1 1 0 11-2 0v-3zm5-1a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                  </svg>
                  <span>IBAN</span>
                </div>
              </div>
            </div>
          </div>
      
          <div id="paypalDetails" class="mb-6">
            <label class="block text-sm font-medium text-gray-400 mb-2">PayPal Email</label>
            <input type="email" placeholder="diini@email.ch" class="bg-slate-800 border border-slate-700 rounded-md py-2 px-3 text-white w-full">
          </div>
      
          <div id="ibanDetails" class="mb-6 hidden">
            <label class="block text-sm font-medium text-gray-400 mb-2">IBAN Number</label>
            <input type="text" placeholder="IBAN..." class="bg-slate-800 border border-slate-700 rounded-md py-2 px-3 text-white w-full">
            <label class="block text-sm font-medium text-gray-400 mt-4 mb-2">Bank Name</label>
            <input type="text" placeholder="Bank name..." class="bg-slate-800 border border-slate-700 rounded-md py-2 px-3 text-white w-full">
          </div>
      
          <button id="confirmWithdrawBtn" class="w-full py-3 rounded-md btn-primary font-medium">
            Confirm Withdrawal
          </button>
        </div>
      </div>
    
    <script>
        // DOM Elements
        const welcomeModal = document.getElementById('welcomeModal');
        const startDemoBtn = document.getElementById('startDemoBtn');
        const depositSlider = document.getElementById('depositSlider');
        const depositInput = document.getElementById('depositInput');
        const marketOptions = document.querySelectorAll('.market-option');
        const strategySelect = document.getElementById('strategySelect');
        const startTradingBtn = document.getElementById('startTradingBtn');
        const pauseBotBtn = document.getElementById('pauseBotBtn');
        const botStatus = document.getElementById('botStatus');
        const chartOverlay = document.getElementById('chartOverlay');
        const noBalanceOverlay = document.getElementById('noBalanceOverlay');
        const balanceDisplay = document.getElementById('balance');
        const currentBalanceDisplay = document.getElementById('currentBalance');
        const availableBalanceDisplay = document.getElementById('availableBalance');
        const profitIndicator = document.getElementById('profitIndicator');
        const balanceDisplayContainer = document.getElementById('balanceDisplay');
        const liveTradesContainer = document.getElementById('liveTradesContainer');
        const totalTradesDisplay = document.getElementById('totalTrades');
        const winRateDisplay = document.getElementById('winRate');
        const profitTodayDisplay = document.getElementById('profitToday');
        const totalProfitDisplay = document.getElementById('totalProfit');
        const tradeHistoryTable = document.getElementById('tradeHistory');
        const timeframeTabs = document.querySelectorAll('.tab');
        const depositBtn = document.getElementById('depositBtn');
        const depositBtnOverlay = document.getElementById('depositBtnOverlay');
        const withdrawBtn = document.getElementById('withdrawBtn');
        const depositModal = document.getElementById('depositModal');
        const withdrawModal = document.getElementById('withdrawModal');
        const confirmDepositBtn = document.getElementById('confirmDepositBtn');
        const confirmWithdrawBtn = document.getElementById('confirmWithdrawBtn');
        const withdrawInput = document.getElementById('withdrawInput');
        const depositPresets = document.querySelectorAll('.deposit-preset');
        const withdrawMethods = document.querySelectorAll('.withdraw-method');
        const paypalDetails = document.getElementById('paypalDetails');
        const ibanDetails = document.getElementById('ibanDetails');
        const closeModalButtons = document.querySelectorAll('.close-modal');
        const tradeMarkers = document.getElementById('tradeMarkers');
        
        // Chart setup
        const ctx = document.getElementById('tradingChart').getContext('2d');
        let tradingChart;
        
        // Trading state
        let isTrading = false;
        let isPaused = false;
        let deposit = 0;
        let balance = 0;
        let initialBalance = 0;
        let selectedMarkets = ['forex'];
        let strategy = 'conservative';
        let totalTrades = 0;
        let winningTrades = 0;
        let profitToday = 0;
        let totalProfit = 0;
        let currentTimeframe = '1m';
        let tradeInterval;
        let chartUpdateInterval;
        let balanceHistory = [];
        let timeLabels = [];
        let tradePositions = [];
        let markerOffsets = {}; // To track marker positions and prevent overlap
        
        // Portfolio to track bought assets
        let portfolio = {};
        
        // Market data
        const markets = {
            forex: [
                { symbol: 'EUR/USD', price: 1.0921 },
                { symbol: 'GBP/EUR', price: 1.1654 },
                { symbol: 'EUR/JPY', price: 149.67 },
                { symbol: 'AUD/EUR', price: 0.6543 },
                { symbol: 'EUR/₣', price: 0.9765 }
            ],
            stocks: [
                { symbol: 'AAPL', price: 173.45 },
                { symbol: 'MSFT', price: 338.12 },
                { symbol: 'GOOGL', price: 131.78 },
                { symbol: 'AMZN', price: 127.56 },
                { symbol: 'TSLA', price: 214.65 }
            ],
            crypto: [
                { symbol: 'BTC/EUR', price: 32420.50 },
                { symbol: 'ETH/EUR', price: 1875.30 },
                { symbol: 'SOL/EUR', price: 42.18 },
                { symbol: 'ADA/EUR', price: 0.3765 },
                { symbol: 'XRP/EUR', price: 0.6123 }
            ],
            commodities: [
                { symbol: 'GOLD', price: 1978.25 },
                { symbol: 'SILVER', price: 23.45 },
                { symbol: 'OIL', price: 78.32 },
                { symbol: 'NAT GAS', price: 3.124 },
                { symbol: 'COPPER', price: 3.765 }
            ]
        };
        
        // Chart data
        let chartData = {
            labels: [],
      datasets: [{
        label: 'Balance',
                data: [],
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 2,
                pointRadius: 0,
                fill: true,
                tension: 0.4
            }]
        };
        
        // Chart options
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false
            },
            scales: {
                x: {
                    grid: {
                        color: 'rgba(75, 85, 99, 0.1)'
                    },
                    ticks: {
                        color: '#9ca3af',
                        maxRotation: 0
                    }
                },
               y: {
    grid: {
        color: 'rgba(75, 85, 99, 0.1)'
    },
    ticks: {
        color: '#9ca3af',
        callback: function(value) {
            return '₣' + value.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        }
    },
    beginAtZero: false,
    suggestedMin: () => Math.min(...chartData.datasets[0].data) - 2,
    suggestedMax: () => Math.max(...chartData.datasets[0].data) + 2
}

            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleColor: '#f3f4f6',
                    bodyColor: '#f3f4f6',
                    borderColor: '#334155',
                    borderWidth: 1,
                    callbacks: {
                        label: function(context) {
                            return 'Balance: ₣ ' + context.parsed.y.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                        }
                    }
                },
                annotation: {
                    annotations: {
                        line1: {
                            type: 'line',
                            yMin: 250,
                            yMax: 250,
                            borderColor: 'rgba(255, 255, 255, 0.3)',
                            borderWidth: 1,
                            borderDash: [5, 5],
                                label: {
                                content: 'Initial Deposit',
                                display: true,
                                position: 'start',
                                backgroundColor: 'rgba(15, 23, 42, 0.8)',
                                color: '#f3f4f6',
                                font: {
                                    size: 10
                                }
                            }
                        }
                    }
                }
            },
            animation: {
                duration: 0
            }
        };
        
        // Initialize chart
        function initChart() {
            tradingChart = new Chart(ctx, {
                type: 'line',
                data: chartData,
                options: chartOptions
            });
        }
        
        // Update chart with new balance
        function updateChart() {
            const now = new Date();
            const timeString = now.toLocaleTimeString();
            
            // Add new data point
            chartData.labels.push(timeString);
            chartData.datasets[0].data.push(balance);
            
            // Keep only the last 100 data points
            if (chartData.labels.length > 100) {
                chartData.labels.shift();
                chartData.datasets[0].data.shift();
                
                // Also update trade positions indices
                tradePositions.forEach(pos => {
                    pos.index--;
                });
                
                // Remove markers that are out of view
                tradePositions = tradePositions.filter(pos => pos.index >= 0);
                
                // Clean up markers that are no longer in view
                const markersToRemove = [];
                tradePositions.forEach(pos => {
                    if (pos.index < 0) {
                        markersToRemove.push(pos.element);
                    }
                });
                
                markersToRemove.forEach(marker => {
                    if (marker.parentNode) {
                        marker.parentNode.removeChild(marker);
                    }
                });
            }
            // Автоматически подстраиваем масштаб Y-оси под текущие данные
const values = chartData.datasets[0].data;
if (values.length > 1) {
    const minY = Math.min(...values);
    const maxY = Math.max(...values);

    const range = maxY - minY || 1; // на случай, если range = 0
    const padding = range * 0.05;   // 5% отступ сверху и снизу

    tradingChart.options.scales.y.min = minY - padding;
    tradingChart.options.scales.y.max = maxY + padding;
}

            // Update chart
            tradingChart.update('none');
            
            // Update trade markers
            updateTradeMarkers();
        }
        
        // Add trade marker to chart
        function addTradeMarker(type, index) {
            const chart = tradingChart;
            if (!chart) return;
            
            // Get position on chart
            const meta = chart.getDatasetMeta(0);
            if (!meta.data[index]) return;
            
            const x = meta.data[index].x;
            const y = meta.data[index].y;
            
            // Check if we need to offset this marker to prevent overlap
            const key = `${index}`;
            if (!markerOffsets[key]) {
                markerOffsets[key] = 0;
            } else {
                markerOffsets[key] += 30; // Offset by 30px vertically
            }
            
            const offset = markerOffsets[key];
            
            // Create marker element
            const marker = document.createElement('div');
            marker.className = `trade-marker ${type.toLowerCase()}`;
            marker.textContent = type === 'BUY' ? 'B' : 'S';
            marker.style.left = `${x}px`;
            marker.style.top = `${y - offset}px`;
            
            // Add to markers container
            tradeMarkers.appendChild(marker);
            
            // Store position for later reference
            tradePositions.push({
                element: marker,
                index: index,
                type: type,
                offset: offset
            });
        }
        
        // Update trade markers positions when chart updates
        function updateTradeMarkers() {
            const chart = tradingChart;
            if (!chart) return;
            
            tradePositions.forEach(position => {
                const meta = chart.getDatasetMeta(0);
                if (!meta.data[position.index]) return;
                
                const x = meta.data[position.index].x;
                const y = meta.data[position.index].y;
                
                position.element.style.left = `${x}px`;
                position.element.style.top = `${y - position.offset}px`;
            });
        }
      function updateBalanceDisplay() {
    const displayedBalance = initialBalance + totalProfit;

    currentBalanceDisplay.textContent = formatCurrency(displayedBalance);
    balanceDisplay.textContent = formatCurrency(displayedBalance);
    availableBalanceDisplay.textContent = formatCurrency(displayedBalance);

    // Calculate profit
    const profit = totalProfit;
    profitIndicator.textContent = (profit >= 0 ? '+' : '') + '₣' + formatCurrency(profit);
    profitIndicator.className = profit >= 0 ? 'text-sm ml-2 profit' : 'text-sm ml-2 loss';

    if (tradingChart) {
        tradingChart.options.plugins.annotation.annotations.line1.yMin = initialBalance;
        tradingChart.options.plugins.annotation.annotations.line1.yMax = initialBalance;
    }
}


        // Format currency
        function formatCurrency(value) {
            return value.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        }
        
        // Generate a trade
        function generateTrade() {
            if (!isTrading || isPaused || balance <= 0) return;
           
            // Select random market from selected markets
            const marketType = selectedMarkets[Math.floor(Math.random() * selectedMarkets.length)];
            const marketAssets = markets[marketType];
            
            // Determine if this is a buy or sell trade
            // If portfolio is empty, always buy first
            const hasBoughtAssets = Object.keys(portfolio).filter(symbol => portfolio[symbol].quantity > 0).length > 0;
            const isBuy = !hasBoughtAssets || Math.random() > 0.5;
            
            let asset, tradeAmount, profitLoss, isWinning;
            
            if (isBuy) {
                // BUY operation
                asset = marketAssets[Math.floor(Math.random() * marketAssets.length)];
                
                // Determine trade parameters based on strategy and balance
                switch (strategy) {
                    case 'conservative':
                        tradeAmount = balance * (Math.random() * 0.01 + 0.01); // 1-2% of balance
                        break;
                    case 'aggressive':
                        tradeAmount = balance * (Math.random() * 0.03 + 0.03); // 3-6% of balance
                        break;
                    default: // balanced
                        tradeAmount = balance * (Math.random() * 0.02 + 0.02); // 2-4% of balance
                }
                
                // Cap trade amount
                tradeAmount = Math.min(tradeAmount, balance * 0.1);
                
                // Add to portfolio
                if (!portfolio[asset.symbol]) {
                    portfolio[asset.symbol] = {
                        quantity: 0,
                        totalInvested: 0,
                        avgPrice: 0
                    };
                }
                
                const quantity = tradeAmount / asset.price;
                portfolio[asset.symbol].quantity += quantity;
                portfolio[asset.symbol].totalInvested += tradeAmount;
                portfolio[asset.symbol].avgPrice = portfolio[asset.symbol].totalInvested / portfolio[asset.symbol].quantity;
                
                // Update balance
                
                // Create trade entry
                addTradeToHistory({
                    time: new Date().toLocaleTimeString(),
                    asset: asset.symbol,
                    type: 'BUY',
                    entry: formatCurrency(asset.price),
                    exit: '-',
                    amount: formatCurrency(tradeAmount),
                    profitLoss: 0
                });
                

                // Show live trade notification
                showLiveTrade({
                    asset: asset.symbol,
                    type: 'BUY',
                    entry: asset.price,
                    amount: tradeAmount,
                    profitLoss: 0,
                    isWinning: true
                });
                
                // Add trade marker to chart
                addTradeMarker('BUY', chartData.labels.length - 1);
                
            } else {
                // SELL operation - only sell assets we own
const ownedAssets = Object.keys(portfolio).filter(symbol => portfolio[symbol].quantity > 0);

// If no assets to sell, skip this trade
if (ownedAssets.length === 0) return;

const assetSymbol = ownedAssets[Math.floor(Math.random() * ownedAssets.length)];

// Find the asset in our markets
let assetFound = false;
for (const market in markets) {
    const foundAsset = markets[market].find(a => a.symbol === assetSymbol);
    if (foundAsset) {
        asset = foundAsset;
        assetFound = true;
        break;
    }
}

if (!assetFound) return;

// Determine if winning trade (95% chance)
isWinning = Math.random() < 0.95;

// Calculate sell amount (sell between 25% and 100% of holdings)
const sellPercentage = Math.random() * 0.75 + 0.25;
const quantityToSell = portfolio[assetSymbol].quantity * sellPercentage;
const originalInvestment = quantityToSell * portfolio[assetSymbol].avgPrice;

// Для прибыльных сделок гарантируем, что цена продажи выше цены покупки
if (isWinning) {
    // Гарантируем, что цена продажи выше цены покупки на 5-15%
    const priceIncrease = Math.random() * 0.10 + 0.05; // 5-15%
    const sellPrice = portfolio[assetSymbol].avgPrice * (1 + priceIncrease);
    
    // Пересчитываем сумму продажи по новой цене
    tradeAmount = quantityToSell * sellPrice;
    
    // Прибыль - это разница между новой суммой и первоначальной инвестицией
    profitLoss = tradeAmount - originalInvestment;
    
    // Обновляем цену актива для отображения
    asset.price = sellPrice;
} else {
    // Для убыточных сделок (редко) - небольшой убыток
    const priceDrop = Math.random() * 0.005 + 0.001; // 0.1-0.6% снижение
    const sellPrice = portfolio[assetSymbol].avgPrice * (1 - priceDrop);
    
    // Пересчитываем сумму продажи по новой цене
    tradeAmount = quantityToSell * sellPrice;
    
    // Убыток - это разница между новой суммой и первоначальной инвестицией
    profitLoss = tradeAmount - originalInvestment;
    
    // Обновляем цену актива для отображения
    asset.price = sellPrice;
}

                // Update portfolio
                portfolio[assetSymbol].quantity -= quantityToSell;
                portfolio[assetSymbol].totalInvested -= quantityToSell * portfolio[assetSymbol].avgPrice;

                // If quantity is very small, consider it sold completely
                if (portfolio[assetSymbol].quantity < 0.0001) {
                    portfolio[assetSymbol].quantity = 0;
                    portfolio[assetSymbol].totalInvested = 0;
                    portfolio[assetSymbol].avgPrice = 0;
                } else if (portfolio[assetSymbol].quantity > 0) {
                    // Recalculate average price if we still have some
                    portfolio[assetSymbol].avgPrice = portfolio[assetSymbol].totalInvested / portfolio[assetSymbol].quantity;
                }

                // Update balance - add both the original investment and profit
balance = initialBalance + totalProfit;
                
                // Update statistics
                totalTrades++;
                if (isWinning) winningTrades++;
                profitToday += profitLoss;
                totalProfit += profitLoss;
                
                // Calculate exit price based on profit/loss
                const exitPrice = asset.price * (1 + (profitLoss / tradeAmount));
                
                // Add to trade history
                addTradeToHistory({
                    time: new Date().toLocaleTimeString(),
                    asset: asset.symbol,
                    type: 'SELL',
                    entry: formatCurrency(portfolio[assetSymbol].avgPrice),
                    exit: formatCurrency(exitPrice),
                    amount: formatCurrency(tradeAmount),
                    profitLoss: profitLoss
                });
                
                // Show live trade notification
                showLiveTrade({
                    asset: asset.symbol,
                    type: 'SELL',
                    entry: portfolio[assetSymbol].avgPrice,
                    exit: exitPrice,
                    amount: tradeAmount,
                    profitLoss: profitLoss,
                    isWinning: isWinning
                });
                
                // Add trade marker to chart
                addTradeMarker('SELL', chartData.labels.length - 1);
                
                // Update statistics displays
                totalTradesDisplay.textContent = totalTrades;
                winRateDisplay.textContent = Math.round((winningTrades / totalTrades) * 100);
                profitTodayDisplay.textContent = formatCurrency(profitToday);
                totalProfitDisplay.textContent = formatCurrency(totalProfit);
                
                // Update chart with new balance
                updateChart();
            }
            
            // Update balance display
            updateBalanceDisplay();
            
            // Update trade markers
            updateTradeMarkers();
        }
        
        // Add trade to history
        function addTradeToHistory(trade) {
            // Clear "no trades" message if present
            if (tradeHistoryTable.querySelector('td[colspan="7"]')) {
                tradeHistoryTable.innerHTML = '';
            }
            
            // Create new row
            const row = document.createElement('tr');
            row.className = 'border-b border-slate-800';
            
            // Add cells
            row.innerHTML = `
                <td class="py-3 text-sm">${trade.time}</td>
                <td class="py-3 text-sm">${trade.asset}</td>
                <td class="py-3 text-sm ${trade.type === 'BUY' ? 'text-neutral-400' : 'text-green-500'}">${trade.type === 'BUY' ? 'BUY' : 'SELL'}</td>
                <td class="py-3 text-sm">₣ ${trade.entry}</td>
                <td class="py-3 text-sm">₣ ${trade.exit}</td>
                <td class="py-3 text-sm">₣ ${trade.amount}</td>
                <td class="py-3 text-sm text-right ${trade.profitLoss >= 0 ? 'text-green-500' : 'text-neutral-400'}">
                    ${trade.profitLoss === 0 ? '-' : (trade.profitLoss >= 0 ? '+' : '') + '₣' + formatCurrency(trade.profitLoss)}
                </td>
            `;
            
            // Add to table
            tradeHistoryTable.insertBefore(row, tradeHistoryTable.firstChild);
            
            // Limit to 20 rows
            if (tradeHistoryTable.children.length > 20) {
                tradeHistoryTable.removeChild(tradeHistoryTable.lastChild);
            }
        }
        
        // Show live trade notification
        function showLiveTrade(trade) {
            // Clear "no trades" message if present
            if (liveTradesContainer.querySelector('div.bg-slate-800')) {
                liveTradesContainer.innerHTML = '';
            }
            
            // Пропускаем уведомления о покупке
            if (trade.type === 'BUY') {
                return;

            }
            
            // Create trade card
            const card = document.createElement('div');
            card.className = `trade-card ${trade.type.toLowerCase()}`;
            
            // Add content - показываем полную сумму при продаже (сумма + прибыль)
card.innerHTML = `
<div class="flex justify-between items-start">
    <div>
        <div class="flex items-center">
            <span class="font-bold">${trade.asset}</span>
            <span class="ml-2 px-2 py-0.5 text-xs rounded-full bg-green-900 text-green-300">SELL</span>
        </div>
  <div class="text-sm text-gray-400 mt-1">Profit</div>
    </div>
    <div class="text-right">
        <div class="${trade.profitLoss >= 0 ? 'text-green-500' : 'text-neutral-400'} font-bold">
            ${trade.profitLoss >= 0 ? '+' : ''}₣${formatCurrency(trade.profitLoss)}
        </div>
  <div class="text-xs text-gray-400 mt-1">Price: ₣ ${formatCurrency(trade.exit)}</div>
    </div>
</div>
`;
            
            // Add to container
            liveTradesContainer.insertBefore(card, liveTradesContainer.firstChild);
            
            // Animate appearance
            setTimeout(() => {
                card.classList.add('active');
            }, 10);
            
            // Remove after 30 seconds
            setTimeout(() => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    if (card.parentNode === liveTradesContainer) {
                        liveTradesContainer.removeChild(card);
                        
                        // Show "no trades" message if no trades
                        if (liveTradesContainer.children.length === 0) {
                            liveTradesContainer.innerHTML = `
                       <div class="bg-slate-800 p-4 rounded-md text-center">
  <p class="text-gray-400">There are no active trades at the moment.</p>
</div>
                    `;
                        }
                    }
                }, 300);
            }, 30000);
        }
        
        // Start trading
        function startTrading() {
            if (isTrading && !isPaused) return;
            
            if (balance <= 0) {
                showModal(depositModal);
                return;
            }
            
            if (isPaused) {
                // Resume trading
                isPaused = false;
                pauseBotBtn.textContent = "Pause";
                pauseBotBtn.classList.remove("text-primary");
                pauseBotBtn.classList.add("text-neutral");
            } else {
                // Start new trading session
                isTrading = true;
                startDemoTimer();

                isPaused = false;
                botStatus.classList.remove('hidden');
                chartOverlay.style.display = 'none';
                liveTradesContainer.classList.remove('hidden');
                balanceDisplayContainer.classList.remove('hidden');
                startTradingBtn.textContent = 'Bot running...';
                startTradingBtn.classList.remove('pulse');
                startTradingBtn.disabled = true;
                
                // Reset values
                initialBalance = balance;
                balanceHistory = [balance];
                timeLabels = [new Date().toLocaleTimeString()];
                profitToday = 0;
                totalProfit = 0;
                totalTrades = 0;
                winningTrades = 0;
                portfolio = {};
                tradePositions = [];
                markerOffsets = {};
                tradeMarkers.innerHTML = '';
                
                // Update displays
                totalTradesDisplay.textContent = totalTrades;
                winRateDisplay.textContent = '0';
                profitTodayDisplay.textContent = formatCurrency(profitToday);
                totalProfitDisplay.textContent = formatCurrency(totalProfit);
                
                // Initialize chart if not already initialized
                if (!tradingChart) {
                    initChart();
                } else {
                    // Reset chart data
                    chartData.labels = [];
                    chartData.datasets[0].data = [];
                    updateChart();
                }
            }
            
            // Generate trades frequently (every 2-5 seconds)
            tradeInterval = setInterval(() => {
                if (!isPaused) {
                    // Generate 1-3 trades per interval
                    const tradeCount = Math.floor(Math.random() * 3) + 1;
                    for (let i = 0; i < tradeCount; i++) {
                        setTimeout(generateTrade, i * 1000); // Space out the trades
                    }
                }
            }, Math.random() * 3000 + 2000);
            
            // Generate first trade immediately
            setTimeout(generateTrade, 500);
        }
        
        // Pause trading
        function pauseTrading() {
            if (!isTrading) return;
            
            if (isPaused) {
                // Resume trading
                isPaused = false;
                pauseBotBtn.textContent = "Pause";
                pauseBotBtn.classList.remove("text-primary");
                pauseBotBtn.classList.add("text-neutral");
                
                // Restart trade interval
                tradeInterval = setInterval(() => {
                    if (!isPaused) {
                        // Generate 1-3 trades per interval
                        const tradeCount = Math.floor(Math.random() * 3) + 1;
                        for (let i = 0; i < tradeCount; i++) {
                            setTimeout(generateTrade, i * 1000); // Space out the trades
                        }
                    }
                }, Math.random() * 3000 + 2000);
            } else {
                // Pause trading
                isPaused = true;
                pauseBotBtn.textContent = "Resume";
                pauseBotBtn.classList.remove("text-neutral");
                pauseBotBtn.classList.add("text-primary");
                
                // Clear interval
                clearInterval(tradeInterval);
            }
        }
        
        // Stop trading
        function stopTrading() {
            isTrading = false;
            isPaused = false;
            botStatus.classList.add('hidden');
            startTradingBtn.textContent = 'Start Trading Bot';
            startTradingBtn.classList.add('pulse');
            startTradingBtn.disabled = false;
            
            clearInterval(tradeInterval);
        }
        
        // Show modal
        function showModal(modal) {
            modal.style.display = 'flex';
            setTimeout(() => {
                modal.style.opacity = '1';
            }, 10);
        }
        
        // Hide modal
        function hideModal(modal) {
            modal.style.opacity = '0';
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        }
        
        // Update strategy recommendations based on balance
        function updateStrategyRecommendations() {
            const options = strategySelect.querySelectorAll('option');
            options.forEach(option => {
                const minBalance = parseInt(option.dataset.min);
                const maxBalance = parseInt(option.dataset.max);
                
                // Remove any existing badge
                const existingBadge = option.querySelector('.strategy-badge');
                if (existingBadge) {
                    existingBadge.remove();
                }
                
                // Add badge if balance is in range
                if (balance >= minBalance && balance <= maxBalance) {
                    const badge = document.createElement('span');
                    badge.className = 'strategy-badge';
                    badge.textContent = '(Recommended)';
                    option.appendChild(badge);
                    
                    // Select this option if it's recommended
                    if (balance > 0 && !isTrading) {
                        option.selected = true;
                        strategy = option.value;
                    }
                }
            });
        }
        
        // Event Listeners
            const stickyheader = document.getElementById("superStickyHeader");

        // Welcome modal
        startDemoBtn.addEventListener('click', function() {
            welcomeModal.style.opacity = '0';
            setTimeout(() => {
                welcomeModal.style.display = 'none';
                
                // Start tutorial
                setTimeout(() => {
                    introJs().setOptions({
                        steps: [
  {
    element: document.querySelector('header'),
    intro: "Welcome to the trading bot demo! This is your dashboard where you can monitor trading activity and performance.",
    position: 'bottom'
  },
  {
    element: document.querySelector('.card'),
    intro: "Here you can configure your trading bot settings, including deposit, markets, and strategy.",
    position: 'right'
  },
  {
    element: document.querySelector('#depositBtn'),
    intro: "First, you need to deposit funds to start trading. Let's deposit 250 to begin.",
    position: 'right'
  },
  {
    element: document.querySelector('.market-option'),
    intro: "Select the markets you want to trade. You can choose multiple markets.",
    position: 'right'
  },
  {
    element: document.querySelector('#strategySelect'),
    intro: "Choose your trading strategy. This affects how the bot manages your capital.",
    position: 'right'
  },
  {
    element: document.querySelector('#startTradingBtn'),
    intro: "Click this button to start the trading bot. It will begin executing trades according to your settings.",
    position: 'right'
  },
  {
    element: document.querySelector('.chart-container'),
    intro: "This is the live trading chart where you can track balance growth and bot activity.",
    position: 'left'
  },
  {
    element: document.querySelector('#liveTradesContainer'),
    intro: "Here you'll see live notifications about trades as they happen.",
    position: 'left'
  },
  {
    element: document.querySelector('.grid.grid-cols-4.gap-4.mt-6'),
    intro: "These stats show your trading performance, including number of trades, win rate, and profits.",
    position: 'top'
  },
  {
    element: document.querySelector('table'),
    intro: "This table shows your latest trades with details for each transaction.",
    position: 'top'
  }

                        ],
                        showBullets: false,
                        showProgress: true,
                        overlayOpacity: 0.8,
                        tooltipClass: 'customTooltip',
                        highlightClass: 'customHighlight',
                        exitOnOverlayClick: false,
                        disableInteraction: false
                    }).oncomplete(function() {
                        // Show deposit modal after intro
                              stickyheader.classList.remove("hidden");

                        showModal(depositModal);
                    }).onexit(function() {
                        // Show deposit modal if exited early
                              stickyheader.classList.remove("hidden");

                        showModal(depositModal);
                    }).start();
                }, 500);
            }, 300);
        });
        
        // Deposit slider
        depositSlider.addEventListener('input', function() {
            depositInput.value = this.value;
        });
        
        // Deposit input
        depositInput.addEventListener('input', function() {
            const value = parseInt(this.value);
            if (value >= 250 && value <= 50000) {
                depositSlider.value = value;
            }
        });
        
        // Deposit presets
        depositPresets.forEach(button => {
            button.addEventListener('click', function() {
                const amount = parseInt(this.dataset.amount);
                depositSlider.value = amount;
                depositInput.value = amount;
            });
        });
        
        // Market selection
        marketOptions.forEach(option => {
            option.addEventListener('click', function() {
                const market = this.dataset.market;
                
                if (this.classList.contains('selected')) {
                    // Only allow deselect if at least one market remains selected
                    if (selectedMarkets.length > 1) {
                        this.classList.remove('selected');
                        selectedMarkets = selectedMarkets.filter(m => m !== market);
                    }
                } else {
                    this.classList.add('selected');
                    selectedMarkets.push(market);
                }
            });
        });
        
        // Withdrawal methods
        withdrawMethods.forEach(method => {
            method.addEventListener('click', function() {
                withdrawMethods.forEach(m => m.classList.remove('selected'));
                this.classList.add('selected');
                
                const methodType = this.dataset.method;
                if (methodType === 'paypal') {
                    paypalDetails.classList.remove('hidden');
                    ibanDetails.classList.add('hidden');
                } else {
                    paypalDetails.classList.add('hidden');
                    ibanDetails.classList.remove('hidden');
                }
            });
        });
        
        // Strategy selection
        strategySelect.addEventListener('change', function() {
            strategy = this.value;
        });
        
        // Start trading button
        startTradingBtn.addEventListener('click', startTrading);
        
        // Pause bot button
        pauseBotBtn.addEventListener('click', pauseTrading);
        
        // Timeframe tabs
        timeframeTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                timeframeTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                currentTimeframe = this.dataset.timeframe;
                
                // Show notification
                const notification = document.createElement('div');
                notification.className = 'fixed bottom-4 right-4 bg-blue-500 text-white px-4 py-2 rounded-md shadow-lg z-50 opacity-0 transition-opacity duration-300';
                notification.textContent = `Timeframe changed to ${currentTimeframe}`;
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.style.opacity = '1';
                    setTimeout(() => {
                        notification.style.opacity = '0';
                        setTimeout(() => {
                            document.body.removeChild(notification);
                        }, 300);
                    }, 2000);
                }, 10);
            });
        });
        
        // Deposit button
        depositBtn.addEventListener('click', function() {
            showModal(depositModal);
        });
        
        // Deposit button in overlay
        depositBtnOverlay.addEventListener('click', function() {
            showModal(depositModal);
        });
        
        // Withdraw button
        withdrawBtn.addEventListener('click', function() {
            availableBalanceDisplay.textContent = formatCurrency(balance);
            withdrawInput.value = Math.min(100, Math.floor(balance));
            withdrawInput.max = balance;
            showModal(withdrawModal);
        });
        
        // Confirm deposit button
        confirmDepositBtn.addEventListener('click', function() {
            const amount = parseInt(depositInput.value);
            if (amount >= 250 && amount <= 50000) {
                balance += amount;
                balanceDisplay.textContent = formatCurrency(balance);
                currentBalanceDisplay.textContent = formatCurrency(balance);
                
                // Initialize chart if not already initialized
                if (!tradingChart) {
                    initChart();
                    chartData.labels = [new Date().toLocaleTimeString()];
                    chartData.datasets[0].data = [balance];

                    tradingChart.update();
                }
                
                // Update strategy recommendations
                updateStrategyRecommendations();
                
                // Hide no balance overlay
                if (balance > 0) {
                    noBalanceOverlay.style.display = 'none';
                    chartOverlay.style.display = 'flex';
                    startTradingBtn.classList.add('pulse');
                }
                
                // Show notification
                const notification = document.createElement('div');
                notification.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg z-50 opacity-0 transition-opacity duration-300';
                notification.textContent = `Deposit of ₣ ${formatCurrency(amount)} completed successfully`;
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.style.opacity = '1';
                    setTimeout(() => {
                        notification.style.opacity = '0';
                        setTimeout(() => {
                            document.body.removeChild(notification);
                        }, 300);
                    }, 2000);
                }, 10);
                
                hideModal(depositModal);
            }
        });
        
        // Confirm withdraw button
        confirmWithdrawBtn.addEventListener('click', function() {
            const amount = parseFloat(withdrawInput.value);
            if (amount > 0 && amount <= balance) {
                balance -= amount;
                balanceDisplay.textContent = formatCurrency(balance);
                currentBalanceDisplay.textContent = formatCurrency(balance);
                
                // Update chart
                if (tradingChart) {
                    chartData.labels.push(new Date().toLocaleTimeString());
                    chartData.datasets[0].data.push(balance);
                    // Автоматически подстраиваем масштаб Y-оси под текущие данные



                    tradingChart.update();
                }
                
                // Update strategy recommendations
                updateStrategyRecommendations();
                
                // Show no balance overlay if balance is 0
                if (balance <= 0) {
                    noBalanceOverlay.style.display = 'flex';
                    chartOverlay.style.display = 'none';
                    if (isTrading) {
                        stopTrading();
                    }
                }
                
                // Show notification
                const notification = document.createElement('div');
                notification.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg z-50 opacity-0 transition-opacity duration-300';
                notification.textContent = `Withdrawal of ₣ ${formatCurrency(amount)} completed successfully`;
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.style.opacity = '1';
                    setTimeout(() => {
                        notification.style.opacity = '0';
                        setTimeout(() => {
                            document.body.removeChild(notification);
                        }, 300);
                    }, 2000);
                }, 10);
                
                hideModal(withdrawModal);
            }
        });
        
        // Close modal buttons
        closeModalButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modal = this.closest('.modal');
                hideModal(modal);
            });
        });
        
        // Close modals when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal')) {
                hideModal(event.target);
            }
        });
        
        // Initialize chart
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize chart
            initChart();
            
            // Update strategy recommendations
            updateStrategyRecommendations();
        });
        
        // Handle chart resize
        window.addEventListener('resize', function() {
            if (tradingChart) {
                tradingChart.resize();
                updateTradeMarkers();
            }
        });
    </script>
    <!-- Countdown Timer -->
  <div id="countdownTimer" class="fixed top-4 left-4 bg-slate-800 text-white text-sm px-4 py-2 rounded-md shadow-lg z-50 hidden">
    ⏳ Time remaining: <span id="countdownDisplay">02:00</span>
    </div>

<!-- Timeout Popup -->
<div id="timeoutPopup" class="fixed inset-0 bg-white/60 backdrop-blur-md flex items-center justify-center z-[9999] hidden">
     <!-- Registration Form (Second) -->
<section id="contato">
  <div class="container mx-auto px-6">

   

    <!-- Форма -->
<div class="max-w-4xl w-full max-h-[90vh] overflow-y-auto bg-gradient-to-br from-gray-900 to-gray-800 p-8 rounded-2xl shadow-2xl border border-gray-700">

         <!-- Блок с анимацией и текстом -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center mb-16">
      <!-- Анимация -->

      <!-- Текст -->
      <div class="text-center md:text-left" data-aos="fade-left">
        <h2 class="text-4xl font-bold mb-4">Ready to <span class="text-gradient">Get Started?</span></h2>
        <p class="text-xl text-gray-300 max-w-3xl mx-auto">
          Fill out the form below and start changing your financial life today.
        </p>
      </div>
    </div>

  
      <form action="thanks/index.php" method="POST" id="registrationForm2" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="nome2" class="block text-sm font-medium text-gray-300 mb-1">First name</label>
            <input type="text" name="f_name" placeholder="John" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required="">
          </div>
          <div>
            <label for="sobrenome2" class="block text-sm font-medium text-gray-300 mb-1">Last name</label>
            <input type="text" name="l_name" placeholder="Doe" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required="">
          </div>
          <div>
            <label for="email2" class="block text-sm font-medium text-gray-300 mb-1">Email address</label>
            <input type="email" name="email" placeholder="juan.perez@email.com" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required="">
          </div>
          <div>
            <label for="telefone2" class="block text-sm font-medium text-gray-300 mb-1">Phone</label>
            <input type="tel" name="phone" placeholder="" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required="">
            <input type="hidden" name="phone2" class="phone2" autocomplete="on" required="">
<input type="hidden" name="pixel_id" value="n">
<input type="hidden" name="page_lang" value="de">
<input type="hidden" name="query" value="m=n">
<input type="hidden" name="gp_id" value="">
<input type="hidden" name="hs_id" value="">
<input type="hidden" name="countryCode" id="countryCode" value="NL">
<input type="hidden" name="ip" id="ip" value="2a00:b703:fff1:102::1">
<input type="hidden" name="fbclid" value="">
<input type="hidden" name="landing" value="MycronyxAI-CH">
          </div>
                 
        <div class="md:col-span-2 pt-2">
      <button type="submit" class="w-full neon-button py-3 rounded-lg font-semibold pulse">
        Get Started
              </button>
        </div>
        <p class="text-xs text-gray-400 text-center md:col-span-2 mt-4">
            By registering you accept our <a href="#" data-popup="termos-uso-popup" class="legal-popup-link text-blue-400 hover:underline">Terms of Use</a> and <a href="#" data-popup="privacidade-popup" class="legal-popup-link text-blue-400 hover:underline">Privacy Policy</a>.
          </p>
      </form>
    </div>
  </div>
</section>

</div>

<script type="text/javascript">
    // Таймер обратного отсчета
let demoTimerInterval;

function startDemoTimer() {
    const countdownDisplay = document.getElementById('countdownDisplay');
    const countdownTimer = document.getElementById('countdownTimer');
    const timeoutPopup = document.getElementById('timeoutPopup');

    let timeLeft = 120; // в секундах
    countdownTimer.classList.remove('hidden');

    demoTimerInterval = setInterval(() => {
        timeLeft--;
        const minutes = String(Math.floor(timeLeft / 60)).padStart(2, '0');
        const seconds = String(timeLeft % 60).padStart(2, '0');
        countdownDisplay.textContent = `${minutes}:${seconds}`;

        if (timeLeft <= 0) {
            clearInterval(demoTimerInterval);
            countdownTimer.classList.add('hidden');

            // Остановить торговлю
            stopTrading();

            // Показать блюр и попап
            timeoutPopup.classList.remove('hidden');
document.body.classList.add('overflow-hidden');
        }
    }, 1000);
}

</script>


<script type="text/javascript">
    // Script para gerenciar popups de documentos legais
document.addEventListener('DOMContentLoaded', function() {
    // Adicionar CSS para os popups
    const style = document.createElement('style');
    style.textContent = `
        .legal-popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }
        
        .legal-popup-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .legal-popup {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #fff;
            width: 90%;
            max-width: 900px;
            max-height: 85vh;
            border-radius: 12px;
            box-shadow: 0 0 30px rgba(0, 163, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        
        .legal-popup-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            background: inherit;
            z-index: 1;
        }
        
        .legal-popup-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #00a3ff;
            margin: 0;
        }
        
        .legal-popup-close {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s;
        }
        
        .legal-popup-close:hover {
            color: #fff;
        }
        
        .legal-popup-content {
            padding: 1.5rem;
            overflow-y: auto;
            flex-grow: 1;
        }
        
        .legal-popup-content h2 {
            color: #00a3ff;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            font-size: 1.25rem;
            font-weight: 600;
        }
        
        .legal-popup-content h3 {
            color: #fff;
            margin-top: 1.25rem;
            margin-bottom: 0.75rem;
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .legal-popup-content p {
            margin-bottom: 1rem;
            line-height: 1.6;
        }
        
        .legal-popup-content ul {
            margin-left: 1.5rem;
            margin-bottom: 1rem;
            list-style-type: disc;
        }
        
        .legal-popup-content li {
            margin-bottom: 0.5rem;
            line-height: 1.6;
        }
        
        .legal-popup-content a {
            color: #00a3ff;
            text-decoration: none;
            transition: text-decoration 0.2s;
        }
        
        .legal-popup-content a:hover {
            text-decoration: underline;
        }
        
        .legal-popup-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.6);
            background: inherit;
        }
        
        .legal-popup-section {
            margin-bottom: 1.5rem;
        }
        
        .legal-popup-alert {
            background-color: rgba(255, 59, 48, 0.1);
            border-left: 4px solid rgba(255, 59, 48, 0.7);
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.25rem;
        }
        
        .legal-popup-company-info {
            background-color: rgba(0, 163, 255, 0.1);
            border: 1px solid rgba(0, 163, 255, 0.2);
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .legal-popup-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }
        
        .legal-popup-table th {
            background-color: rgba(0, 163, 255, 0.1);
            text-align: left;
            padding: 0.75rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .legal-popup-table td {
            padding: 0.75rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .legal-popup-table tr:last-child td {
            border-bottom: none;
        }
        
        /* Estilos para links que abrem os popups */
        .legal-popup-link {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.2s;
            cursor: pointer;
        }
        
        .legal-popup-link:hover {
            color: #fff;
            text-decoration: underline;
        }
        
        /* Desativar scroll do body quando popup está aberto */
        body.popup-open {
            overflow: hidden;
        }
        
        /* Responsividade para dispositivos móveis */
        @media (max-width: 768px) {
            .legal-popup {
                width: 95%;
                max-height: 90vh;
            }
            
            .legal-popup-header {
                padding: 1rem;
            }
            
            .legal-popup-content {
                padding: 1rem;
            }
            
            .legal-popup-title {
                font-size: 1.25rem;
            }
        }
    `;
    document.head.appendChild(style);
    
    // Criar estrutura HTML para os popups
    const popupHTML = `
      <div id="termos-uso-popup" class="legal-popup-overlay">
  <div class="legal-popup">
    <div class="legal-popup-header">
      <h2 class="legal-popup-title">Terms of Use</h2>
      <button class="legal-popup-close" data-close="termos-uso-popup">×</button>
    </div>
    <div class="legal-popup-content">
      <!-- Terms content -->
      <p>Last updated: May 7, 2025</p>

      <div class="legal-popup-section">
  <h2>1. Acceptance of Terms</h2>
  <p>By accessing or using the services of Impulso Invest, operated by Micronyx AI Ltd., you agree to comply with and be bound by these Terms of Use. If you do not agree with any part of these terms, you may not use our services.</p>
      </div>

      <div class="legal-popup-section">
        <h2>2. Description of Services</h2>
        <p>Impulso Invest provides automated trading services using AI algorithms. Our services include, among others:</p>
        <ul>
          <li>Real-time market analysis</li>
          <li>Automated trade execution</li>
          <li>Portfolio management</li>
          <li>Performance reports</li>
        </ul>
      </div>

      <div class="legal-popup-section">
        <h2>3. Investment Risks</h2>
        <p>All investments involve risk. Past performance does not guarantee future results. By using our services, you acknowledge that:</p>
        <ul>
          <li>The value of investments can rise or fall</li>
          <li>You may receive less back than you originally invested</li>
          <li>Currency fluctuations can affect the value of your investments</li>
        </ul>
        <p>We recommend obtaining independent financial advice before making investment decisions.</p>
      </div>

      <div class="legal-popup-section">
        <h2>4. Eligibility</h2>
        <p>To use our services, you must:</p>
        <ul>
          <li>Be at least 18 years old</li>
          <li>Be legally capable of entering into binding contracts</li>
          <li>Not be legally prohibited from using our services</li>
          <li>Provide truthful and complete information during registration</li>
        </ul>
      </div>

      <div class="legal-popup-section">
  <h2>5. Privacy</h2>
  <p>Protecting your personal data is important to us. Our <a href="#" class="popup-trigger" data-popup="privacidade-popup">Privacy Policy</a> describes how we collect, use, and protect your personal data.</p>
      </div>

      <div class="legal-popup-section">
  <h2>6. Intellectual Property</h2>
  <p>All content, designs, graphics, interfaces, code, and software on our website and services are the property of Micronyx AI Ltd. and protected by intellectual property law.</p>
      </div>

      <div class="legal-popup-section">
  <h2>7. Limitation of Liability</h2>
  <p>Neither Micronyx AI Ltd. nor its directors, employees, or affiliates shall be liable for direct, indirect, incidental, special, or consequential damages arising from the use or inability to use our services.</p>
      </div>

      <div class="legal-popup-section">
  <h2>8. Changes to Terms</h2>
  <p>We reserve the right to modify these terms at any time. Changes take effect immediately upon posting the updated terms. Continued use of our services constitutes acceptance of the new terms.</p>
      </div>

      <div class="legal-popup-section">
  <h2>9. Governing Law</h2>
  <p>These terms are governed by and construed in accordance with the laws of Switzerland, without regard to conflict of law principles.</p>
      </div>

      <div class="legal-popup-section">
        <h2>10. Contact</h2>
        <p>If you have questions about these Terms of Use, please contact us:</p>
        <p>Av. da Liberdade 110<br>1269-046 Lissabon,<br>Portugal</p>
        <p>Email: <a href="mailto:contato@micronyxai.com">contato@micronyxai.com</a></p>
      </div>
    </div>
    <div class="legal-popup-footer">
      © 2025 Micronyx AI Ltd. All rights reserved.<br>
      CMVM License No. 37925 | Commercial Registry: 287190345
    </div>
  </div>
</div>


        <div id="privacidade-popup" class="legal-popup-overlay">
  <div class="legal-popup">
    <div class="legal-popup-header">
  <h2 class="legal-popup-title">Privacy Policy</h2>
      <button class="legal-popup-close" data-close="privacidade-popup">×</button>
    </div>
    <div class="legal-popup-content">
  <p>Last updated: May 7, 2025</p>
  <p>Micronyx AI Ltd., operator of Impulso Invest, is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and protect your personal data when you use our services.</p>

      <div class="legal-popup-section">
  <h2>1. Data We Collect</h2>
  <p>We may collect the following types of data:</p>

        <h3>1.1 Personal Data</h3>
        <ul>
          <li>Full name</li>
          <li>Email address</li>
          <li>Phone number</li>
          <li>Home address</li>
          <li>Date of birth</li>
          <li>Identification documents (e.g., passport or ID card)</li>
          <li>Financial data (e.g., bank information)</li>
        </ul>

        <h3>1.2 Usage Data</h3>
        <ul>
          <li>IP address</li>
          <li>Browser and device type</li>
          <li>Pages visited and time spent</li>
          <li>Clicks and interactions on the website</li>
          <li>Transaction history</li>
        </ul>
      </div>

      <div class="legal-popup-section">
        <h2>2. How We Use Your Data</h2>
        <p>We use your personal data for the following purposes:</p>
        <ul>
          <li>Provide and maintain our services</li>
          <li>Process transactions and manage your account</li>
          <li>Comply with legal and regulatory obligations</li>
          <li>Prevent fraud and illegal activities</li>
          <li>Improve our services and develop new features</li>
          <li>Communicate updates, offers, and events</li>
          <li>Personalize your user experience</li>
        </ul>
      </div>

      <div class="legal-popup-section">
        <h2>3. Legal Bases for Processing</h2>
        <p>We process your personal data based on the following legal bases:</p>
        <ul>
          <li><strong>Contract performance:</strong> When processing is necessary to perform a contract with you</li>
          <li><strong>Consent:</strong> When you have given us your explicit consent</li>
          <li><strong>Legal obligation:</strong> When processing is necessary to comply with a legal obligation</li>
          <li><strong>Legitimate interests:</strong> When processing is necessary for our legitimate interests without overriding your rights and freedoms</li>
        </ul>
      </div>

      <div class="legal-popup-section">
        <h2>4. Sharing Your Data</h2>
        <p>We may share your personal data with:</p>
        <ul>
          <li><strong>Service providers:</strong> Companies that help us deliver our services (e.g., payment processors, hosting providers)</li>
          <li><strong>Business partners:</strong> Companies we collaborate with to offer services</li>
          <li><strong>Regulatory authorities:</strong> When required by law or regulation</li>
          <li><strong>Potential buyers:</strong> In the event of a merger, acquisition, or sale of assets</li>
        </ul>
        <p>We do not sell your personal data to third parties.</p>
      </div>

      <div class="legal-popup-section">
  <h2>5. Cookies and Similar Technologies</h2>
  <p>We use cookies and similar technologies to enhance your experience, analyze traffic, and personalize content. You can control the use of cookies through your browser settings. For more information, please read our <a href="#" class="popup-trigger" data-popup="cookies-popup">Cookie Policy</a>.</p>
      </div>

      <div class="legal-popup-section">
  <h2>6. Data Security</h2>
  <p>We have implemented technical and organizational measures to protect your personal data from unauthorized access, loss, or alteration. These include encryption, firewalls, and access controls.</p>
      </div>

      <div class="legal-popup-section">
  <h2>7. Data Retention</h2>
  <p>We retain your personal data only as long as necessary for the purposes described in this policy, unless a longer retention period is required or permitted by law.</p>
      </div>

      <div class="legal-popup-section">
        <h2>8. Your Rights</h2>
        <p>Depending on your location, you may have the following rights regarding your personal data:</p>
        <ul>
          <li>Access your personal data</li>
          <li>Correct inaccurate data</li>
          <li>Delete your personal data</li>
          <li>Restrict or object to processing</li>
          <li>Data portability</li>
          <li>Withdraw your consent</li>
        </ul>
        <p>To exercise these rights, please contact us using the contact information below.</p>
      </div>

      <div class="legal-popup-section">
  <h2>9. International Data Transfers</h2>
  <p>Your personal data may be transferred to and processed in countries outside your country of residence. We implement appropriate safeguards to ensure the security of your data in accordance with this policy.</p>
      </div>

      <div class="legal-popup-section">
  <h2>10. Changes to This Policy</h2>
  <p>We may update this Privacy Policy from time to time. The current version is always available on our website and includes the date of the last update. We encourage you to review this policy regularly.</p>
      </div>

      <div class="legal-popup-section">
  <h2>11. Contact</h2>
  <p>If you have questions about this Privacy Policy or our processing of your personal data, please contact us:</p>
        <p>Av. da Liberdade 110<br>1269-046 Lissabon,<br>Portugal</p>
  <p>Email: <a href="mailto:contato@micronyxai.com">contato@micronyxai.com</a></p>
      </div>
    </div>
    <div class="legal-popup-footer">
      © 2025 Micronyx AI Ltd. All rights reserved.<br>
      CMVM License No. 37925 | Commercial Registry: 287190345
    </div>
  </div>
</div>
        
<div id="cookies-popup" class="legal-popup-overlay">
  <div class="legal-popup">
    <div class="legal-popup-header">
  <h2 class="legal-popup-title">Cookie Policy</h2>
      <button class="legal-popup-close" data-close="cookies-popup">×</button>
    </div>
    <div class="legal-popup-content">
  <p>Last updated: May 7, 2025</p>
  <p>This Cookie Policy explains how Micronyx AI Ltd., operator of Impulso Invest, uses cookies and similar technologies on our website. We recommend reading this policy to understand what types of cookies we use, what information we collect, and how we use it.</p>

      <div class="legal-popup-section">
  <h2>1. What are Cookies?</h2>
  <p>Cookies are small text files stored on your device (computer, tablet, or mobile) when you visit a website. They are commonly used to make websites work more efficiently and to provide information to website owners.</p>
  <p>Cookies allow a website to recognize your device and store certain information about your visit, such as language preferences or login details. This can make your next visit easier and the website more useful to you.</p>
      </div>

      <div class="legal-popup-section">
  <h2>2. Types of Cookies We Use</h2>
  <p>We use the following types of cookies on our website:</p>

  <h3>2.1 Essential Cookies</h3>
  <p>These cookies are necessary for the basic functionality of the website. They enable navigation and access to secure areas. Without these cookies, many of the services you request cannot be provided.</p>

  <h3>2.2 Preference Cookies</h3>
  <p>These cookies remember your previous settings, such as preferred language, region, text size, or other personalized options. They help provide a more tailored experience.</p>

  <h3>2.3 Analytics Cookies</h3>
  <p>We use analytics cookies to understand how visitors interact with our website. They help us improve site functionality, measure performance, and evaluate the effectiveness of our marketing campaigns. All information collected by these cookies is aggregated and anonymized.</p>

  <h3>2.4 Marketing Cookies</h3>
  <p>These cookies are used to track visitors across websites. The goal is to display relevant and engaging ads for individual users, which are more valuable for publishers and third-party advertisers.</p>
      </div>

      <div class="legal-popup-section">
  <h2>3. Specific Cookies We Use</h2>
  <p>The table below lists some of the main cookies we use and their purpose:</p>

        <table class="legal-popup-table">
          <thead>
            <tr>
              <th>Cookie Name</th>
              <th>Type</th>
              <th>Purpose</th>
              <th>Duration</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>session_id</td>
              <td>Essential</td>
              <td>Maintains user session state</td>
              <td>Session</td>
            </tr>
            <tr>
              <td>auth_token</td>
              <td>Essential</td>
              <td>User authentication</td>
              <td>30 days</td>
            </tr>
            <tr>
              <td>language_pref</td>
              <td>Preference</td>
              <td>Stores user's preferred language</td>
              <td>1 year</td>
            </tr>
            <tr>
              <td>_ga</td>
              <td>Analytics</td>
              <td>Used by Google Analytics to distinguish users</td>
              <td>2 years</td>
            </tr>
            <tr>
              <td>_gid</td>
              <td>Analytics</td>
              <td>Used by Google Analytics to distinguish users</td>
              <td>24 hours</td>
            </tr>
            <tr>
              <td>_fbp</td>
              <td>Marketing</td>
              <td>Used by Facebook to deliver ads</td>
              <td>3 months</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="legal-popup-section">
  <h2>4. Third-Party Cookies</h2>
  <p>In addition to our own cookies (first-party cookies), we also use third-party cookies on our website. These are set by a domain other than the website you are visiting. We use third-party cookies for the following purposes:</p>
        <ul>
          <li>Traffic analysis (Google Analytics)</li>
          <li>Marketing and advertising (Facebook, Google Ads)</li>
          <li>Social media features (Facebook, Twitter, LinkedIn)</li>
          <li>Security improvements and fraud prevention</li>
        </ul>
      </div>

      <div class="legal-popup-section">
  <h2>5. How to Manage Cookies</h2>
  <p>Most browsers allow you to control cookies through settings or preferences. You can set your browser to refuse all cookies or to notify you when a cookie is being sent. If you refuse cookies, some features of our website may not function properly.</p>

        <h3>5.1 Browser Settings</h3>
        <ul>
          <li><strong>Google Chrome:</strong> Menu > Settings > Advanced > Privacy and security > Site settings > Cookies</li>
          <li><strong>Mozilla Firefox:</strong> Menu > Options > Privacy & Security > Cookies and Site Data</li>
          <li><strong>Safari:</strong> Preferences > Privacy > Cookies and Website Data</li>
          <li><strong>Microsoft Edge:</strong> Menu > Settings > Cookies and site permissions > Cookies</li>
        </ul>

        <h3>5.2 Opt-out Tools</h3>
        <p>You can also opt-out of certain third-party cookies:</p>
        <ul>
          <li>Google Analytics: <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener noreferrer">https://tools.google.com/dlpage/gaoptout</a></li>
          <li>Facebook: <a href="https://www.facebook.com/settings/?tab=ads" target="_blank" rel="noopener noreferrer">https://www.facebook.com/settings/?tab=ads</a></li>
        </ul>
      </div>

      <div class="legal-popup-section">
  <h2>6. Changes to This Policy</h2>
  <p>We may update this Cookie Policy from time to time to reflect changes in our use of cookies or for operational, legal, or regulatory reasons. We encourage you to visit this page regularly to stay informed about our use of cookies and related technologies.</p>
  <p>The date at the top of this policy indicates when it was last updated.</p>
      </div>

      <div class="legal-popup-section">
  <h2>7. Contact</h2>
  <p>If you have questions about this Cookie Policy, please contact us:</p>
        <p>Av. da Liberdade 110<br>1269-046 Lissabon,<br>Portugal</p>
  <p>Email: <a href="mailto:contato@micronyxai.com">contato@micronyxai.com</a></p>
      </div>
    </div>
    <div class="legal-popup-footer">
      © 2025 Micronyx AI Ltd. All rights reserved.<br>
      CMVM License No. 37925 | Commercial Registry: 287190345
    </div>
  </div>
</div>

<div id="risco-popup" class="legal-popup-overlay">
  <div class="legal-popup">
    <div class="legal-popup-header">
  <h2 class="legal-popup-title">Risk Disclosure</h2>
      <button class="legal-popup-close" data-close="risco-popup">×</button>
    </div>
    <div class="legal-popup-content">
      <div class="legal-popup-alert">
  <p class="font-bold" style="color: #ff4d4d;">IMPORTANT: Trading and investing involve significant risks. Please read this notice carefully before using our services.</p>
      </div>

  <p>Last updated: May 7, 2025</p>
  <p>This risk disclosure informs users of Impulso Invest about the risks associated with automated trading and investing in general. It is important that you fully understand these risks before using our services.</p>

      <div class="legal-popup-section">
        <h2>1. General Investment Risks</h2>
        <p>All financial investments carry risks. The value of your investments may rise or fall, and you may receive less than you originally invested. Past performance does not guarantee future returns.</p>
        <ul>
          <li>Financial markets can be volatile and prices of financial instruments can fluctuate significantly</li>
          <li>Investments are subject to market, liquidity, credit, and other risks</li>
          <li>Economic, political, and social factors can affect performance</li>
          <li>Currency fluctuations can negatively impact value or returns</li>
        </ul>
      </div>

      <div class="legal-popup-section">
        <h2>2. Specific Risks of Automated Trading</h2>
        <p>Automated trading and AI-based systems like Impulso Invest carry additional risks:</p>
        <ul>
          <li><strong>Technical failures:</strong> Automated systems can experience outages, e.g., connectivity issues, hardware/software faults, programming errors</li>
          <li><strong>Algorithmic limitations:</strong> Algorithms rely on historical data and may be unsuitable under new market conditions</li>
          <li><strong>Execution speed:</strong> Delays can lead to slippage and different prices</li>
          <li><strong>Technological dependency:</strong> Automated trading depends on infrastructure that can fail</li>
          <li><strong>Overfitting:</strong> Models may be overly fitted to past data and perform poorly in the future</li>
        </ul>
      </div>

      <div class="legal-popup-section">
        <h2>3. Suitability for Investors</h2>
        <p>Before using Impulso Invest, carefully consider whether this service is suitable for you, taking into account:</p>
        <ul>
          <li>Your investment objectives</li>
          <li>Your financial situation and resources</li>
          <li>Your investment experience and knowledge</li>
          <li>Your risk tolerance</li>
          <li>Your ability to bear losses</li>
        </ul>
        <p>If in doubt about suitability, we recommend consulting an independent financial advisor.</p>
      </div>

      <div class="legal-popup-section">
  <h2>4. Limitation of Liability</h2>
  <p>Micronyx AI Ltd. does not guarantee profits or specific outcomes from using Impulso Invest. We are not liable for direct or indirect losses or damages arising from the use of our services.</p>
  <p>By using Impulso Invest, you acknowledge and accept all risks associated with automated trading and investing.</p>
      </div>

      <div class="legal-popup-section">
        <h2>5. Precautions</h2>
        <p>To mitigate the risks of automated trading, we recommend:</p>
        <ul>
          <li>Invest only capital you can afford to lose</li>
          <li>Diversify your investments</li>
          <li>Monitor system performance regularly</li>
          <li>Set clear loss limits</li>
          <li>Stay informed about market conditions</li>
          <li>Start with small amounts until you are familiar with the system</li>
        </ul>
      </div>

      <div class="legal-popup-company-info">
  <h3>About Micronyx AI Ltd.</h3>
  <p>Micronyx AI is a financial technology developed by Micronyx AI Ltd., authorized and supervised by the CMVM (Comissão do Mercado de Valores Mobiliários) under license number 37925.</p>
  <p>The AI trading system operates in accordance with EU law and is independently audited.</p>
        <p style="margin-top: 0.75rem;">
          <strong>CMVM License:</strong> No. 37925<br>
          <strong>Commercial Registry:</strong> 287190345
        </p>
      </div>

      <div class="legal-popup-section">
  <h2>6. Changes to this Disclosure</h2>
  <p>This risk disclosure may be updated periodically. We encourage you to review it regularly to stay informed about the risks of our services.</p>
      </div>

      <div class="legal-popup-section">
  <h2>7. Contact</h2>
  <p>If you have questions about this risk disclosure, you can contact us at:</p>
        <p>Av. da Liberdade 110<br>1269-046 Lissabon,<br>Portugal</p>
  <p>Email: <a href="mailto:contato@micronyxai.com">contato@micronyxai.com</a></p>
      </div>
    </div>
    <div class="legal-popup-footer">
      © 2025 Micronyx AI Ltd. All rights reserved.<br>
      CMVM License No. 37925 | Commercial Registry: 287190345
    </div>
  </div>
</div>
    `;
    
    // Adicionar os popups ao final do body
    const popupContainer = document.createElement('div');
    popupContainer.innerHTML = popupHTML;
    document.body.appendChild(popupContainer);
    
    // Função para abrir popup
    function openPopup(popupId) {
        const popup = document.getElementById(popupId);
        if (popup) {
            popup.classList.add('active');
            document.body.classList.add('popup-open');
            
            // Focar no popup para acessibilidade
            const popupContent = popup.querySelector('.legal-popup-content');
            if (popupContent) {
                popupContent.focus();
            }
        }
    }
    
    // Função para fechar popup
    function closePopup(popupId) {
        const popup = document.getElementById(popupId);
        if (popup) {
            popup.classList.remove('active');
            document.body.classList.remove('popup-open');
        }
    }
    
    // Adicionar event listeners para botões de fechar
    document.querySelectorAll('.legal-popup-close').forEach(button => {
        button.addEventListener('click', function() {
            const popupId = this.getAttribute('data-close');
            closePopup(popupId);
        });
    });
    
    // Fechar popup ao clicar fora dele
    document.querySelectorAll('.legal-popup-overlay').forEach(overlay => {
        overlay.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('active');
                document.body.classList.remove('popup-open');
            }
        });
    });
    
    // Adicionar event listeners para links internos entre popups
    document.querySelectorAll('.popup-trigger').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const currentPopup = this.closest('.legal-popup-overlay').id;
            const targetPopup = this.getAttribute('data-popup');
            
            closePopup(currentPopup);
            setTimeout(() => {
                openPopup(targetPopup);
            }, 300);
        });
    });
    
    // Fechar popup com tecla ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.legal-popup-overlay.active').forEach(popup => {
                popup.classList.remove('active');
                document.body.classList.remove('popup-open');
            });
        }
    });
    
    // Função para adicionar links no rodapé ou em qualquer lugar da página
    function addLegalLinks() {
        // Procurar por elementos com a classe 'legal-links' para adicionar os links
        const legalLinksContainers = document.querySelectorAll('.legal-links');
        
        if (legalLinksContainers.length === 0) {
            // Se não encontrar containers específicos, adicionar ao rodapé
            const footer = document.querySelector('footer');
            if (footer) {
                const linksContainer = document.createElement('div');
                linksContainer.className = 'legal-links flex flex-wrap space-x-4 justify-center mt-4';
           linksContainer.innerHTML = `
             <a href="#" class="legal-popup-link text-sm" data-popup="termos-uso-popup">Terms of Use</a>
<a href="#" class="legal-popup-link text-sm" data-popup="privacidade-popup">Privacy Policy</a>
<a href="#" class="legal-popup-link text-sm" data-popup="cookies-popup">Cookie Policy</a>
<a href="#" class="legal-popup-link text-sm" data-popup="risco-popup">Risk Disclosure</a>
           `;
                footer.appendChild(linksContainer);
            }
        } else {
            // Adicionar links aos containers existentes
            legalLinksContainers.forEach(container => {
                container.innerHTML = `
                <a href="#" class="legal-popup-link" data-popup="termos-uso-popup">Terms of Use</a>
<a href="#" class="legal-popup-link" data-popup="privacidade-popup">Privacy Policy</a>
<a href="#" class="legal-popup-link" data-popup="cookies-popup">Cookie Policy</a>
<a href="#" class="legal-popup-link" data-popup="risco-popup">Risk Disclosure</a>
                `;
            });
        }
        
        // Adicionar event listeners para os links
        document.querySelectorAll('.legal-popup-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const popupId = this.getAttribute('data-popup');
                openPopup(popupId);
            });
        });
    }
    
    // Adicionar links legais
    addLegalLinks();
    
    // Expor funções para uso global
    window.legalPopups = {
        open: openPopup,
        close: closePopup
    };
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fullAccessBtn = document.getElementById('full_access');

    if (fullAccessBtn) {
        fullAccessBtn.addEventListener('click', function (e) {
            e.preventDefault();

            // Остановить торговлю
            stopTrading();

            // Скрыть таймер, если он ещё виден
            const countdownTimer = document.getElementById('countdownTimer');
            if (countdownTimer) {
                countdownTimer.classList.add('hidden');
            }

            // Очистить таймер, если он активен
            if (typeof demoTimerInterval !== 'undefined') {
                clearInterval(demoTimerInterval);
            }

            // Показать попап окончания
            const timeoutPopup = document.getElementById('timeoutPopup');
            if (timeoutPopup) {
                timeoutPopup.classList.remove('hidden');
            }

            // Заблокировать прокрутку
            document.body.classList.add('overflow-hidden');
        });
    }
});
</script>
<style>
@keyframes neonPulse {
    0% {
        box-shadow: 0 0 0px rgba(0, 255, 255, 0.7), 0 0 10px rgba(0, 255, 255, 0.6), 0 0 20px rgba(0, 255, 255, 0.4);
        transform: scale(1);
    }
    50% {
        box-shadow: 0 0 15px rgba(0, 255, 255, 0.9), 0 0 25px rgba(0, 255, 255, 0.8), 0 0 35px rgba(0, 255, 255, 0.7);
        transform: scale(1.05);
    }
    100% {
        box-shadow: 0 0 0px rgba(0, 255, 255, 0.7), 0 0 10px rgba(0, 255, 255, 0.6), 0 0 20px rgba(0, 255, 255, 0.4);
        transform: scale(1);
    }
}

.super-highlight {
    animation: neonPulse 1.5s infinite;
    background-color: #0ff !important;
    color: #0f172a !important;
    border: 2px solid #0ff;
    font-weight: bold;
    text-transform: uppercase;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const startBtn = document.getElementById('startTradingBtn');
    if (startBtn) {
        startBtn.classList.add('super-highlight');
    }
});
</script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    lucide.createIcons();
  });
</script>
<script>
// Функция для проверки и исправления обучалки на мобильных устройствах
function fixMobileTutorial() {

  // Проверяем, запущена ли обучалка
  const isTutorialRunning = document.querySelector('.introjs-overlay') !== null;

  if (!isTutorialRunning) return;
  
  // Проверяем, находимся ли мы на мобильном устройстве
  const isMobile = window.innerWidth <= 768;

  if (!isMobile) return;
  
  // Находим все элементы обучалки
  const overlay = document.querySelector('.introjs-overlay');
  const helperLayer = document.querySelector('.introjs-helperLayer');
  const tooltipLayer = document.querySelector('.introjs-tooltipReferenceLayer');
  const tooltip = document.querySelector('.introjs-tooltip');
  

  
  // Если нашли тултип, принудительно фиксируем его внизу экрана
  if (tooltip) {
    tooltip.style.cssText = `
      position: fixed !important;
      top: auto !important;
      bottom: 0 !important;
      left: 0 !important;
      right: 0 !important;
      width: 100% !important;
      max-width: 100% !important;
      margin: 0 !important;
      border-radius: 12px 12px 0 0 !important;
      box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.3) !important;
      z-index: 999999999 !important;
      transform: none !important;
      transition: none !important;
      height: auto !important;
      min-height: 150px !important;
      max-height: 40% !important;
      overflow-y: auto !important;
    `;
    
    // Скрываем стрелку
    const arrow = tooltip.querySelector('.introjs-arrow');
    if (arrow) {
      arrow.style.display = 'none';
    }
    
    // Проверяем, видны ли кнопки
    const buttons = tooltip.querySelector('.introjs-tooltipbuttons');
    if (buttons) {
      buttons.style.cssText = `
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
        justify-content: space-between !important;
      `;
      
      // Проверяем все кнопки
      const allButtons = buttons.querySelectorAll('.introjs-button');

      allButtons.forEach((button, index) => {
        button.style.cssText = `
          padding: 12px 15px !important;
          font-size: 16px !important;
          margin: 5px !important;
          display: inline-block !important;
          visibility: visible !important;
          opacity: 1 !important;
        `;
      });
    }
  }
  
  // Скроллим к выделенному элементу
  const highlightedElement = document.querySelector('.introjs-helperLayer');
  if (highlightedElement) {
    const rect = highlightedElement.getBoundingClientRect();
    const tooltipHeight = tooltip ? tooltip.offsetHeight : 200;
    const scrollPosition = window.pageYOffset + rect.top - (window.innerHeight - tooltipHeight - rect.height) / 2;
    
    window.scrollTo({
      top: scrollPosition,
      behavior: 'smooth'
    });
  }
}

// Запускаем функцию каждые 500мс
setInterval(fixMobileTutorial, 500);

// Также запускаем при изменении размера окна
window.addEventListener('resize', fixMobileTutorial);

// Запускаем сразу после загрузки страницы
document.addEventListener('DOMContentLoaded', fixMobileTutorial);

// Запускаем при клике на любой элемент страницы
document.addEventListener('click', function() {
  setTimeout(fixMobileTutorial, 100);
  setTimeout(fixMobileTutorial, 300);
  setTimeout(fixMobileTutorial, 500);
});


</script>


<div>
    <div id="termos-uso-popup" class="legal-popup-overlay">
        <div class="legal-popup">
          <div class="legal-popup-header">
            <h2 class="legal-popup-title">Terms of Use</h2>
            <button class="legal-popup-close" data-close="termos-uso-popup">×</button>
          </div>
          <div class="legal-popup-content">
            <!-- Terms content -->
            <p>Last updated: May 7, 2025</p>
      
            <div class="legal-popup-section">
              <h2>1. Acceptance of Terms</h2>
              <p>By accessing or using the services of Impulso Invest, operated by Micronyx AI Ltd., you agree to comply with and be bound by these Terms of Use. If you do not agree with any part of these terms, you may not use our services.</p>
            </div>
      
            <div class="legal-popup-section">
              <h2>2. Description of Services</h2>
              <p>Impulso Invest provides automated trading services using AI algorithms. Our services include, among others:</p>
              <ul>
                <li>Real-time market analysis</li>
                <li>Automated trade execution</li>
                <li>Portfolio management</li>
                <li>Performance reports</li>
              </ul>
            </div>
      
            <div class="legal-popup-section">
              <h2>3. Investment Risks</h2>
              <p>All investments involve risk. Past performance does not guarantee future results. By using our services, you acknowledge that:</p>
              <ul>
                <li>The value of investments can rise or fall</li>
                <li>You may receive less back than you originally invested</li>
                <li>Currency fluctuations can affect the value of your investments</li>
              </ul>
              <p>We recommend obtaining independent financial advice before making investment decisions.</p>
            </div>
      
            <div class="legal-popup-section">
              <h2>4. Eligibility</h2>
              <p>To use our services, you must:</p>
              <ul>
                <li>Be at least 18 years old</li>
                <li>Be legally capable of entering into binding contracts</li>
                <li>Not be legally prohibited from using our services</li>
                <li>Provide truthful and complete information during registration</li>
              </ul>
            </div>
      
            <div class="legal-popup-section">
              <h2>5. Privacy</h2>
              <p>Protecting your personal data is important to us. Our <a href="#" class="popup-trigger" data-popup="privacidade-popup">Privacy Policy</a> describes how we collect, use, and protect your personal data.</p>
            </div>
      
            <div class="legal-popup-section">
              <h2>6. Intellectual Property</h2>
              <p>All content, designs, graphics, interfaces, code, and software on our website and services are the property of Micronyx AI Ltd. and protected by intellectual property law.</p>
            </div>
      
            <div class="legal-popup-section">
              <h2>7. Limitation of Liability</h2>
              <p>Neither Micronyx AI Ltd. nor its directors, employees, or affiliates shall be liable for direct, indirect, incidental, special, or consequential damages arising from the use or inability to use our services.</p>
            </div>
      
            <div class="legal-popup-section">
              <h2>8. Changes to Terms</h2>
              <p>We reserve the right to modify these terms at any time. Changes take effect immediately upon posting the updated terms. Continued use of our services constitutes acceptance of the new terms.</p>
            </div>
      
            <div class="legal-popup-section">
              <h2>9. Governing Law</h2>
              <p>These terms are governed by and construed in accordance with the laws of Switzerland, without regard to conflict of law principles.</p>
            </div>
      
            <div class="legal-popup-section">
              <h2>10. Contact</h2>
              <p>If you have questions about these Terms of Use, please contact us:</p>
              <p>Av. da Liberdade 110<br>1269-046 Lissabon,<br>Portugal</p>
              <p>Email: <a href="/cdn-cgi/l/email-protection#8cefe3e2f8edf8e3cce1e5effee3e2f5f4ede5a2efe3e1"><span class="__cf_email__" data-cfemail="aac9c5c4decbdec5eac7c3c9d8c5c4d3d2cbc384c9c5c7">[email�protected]</span></a></p>
            </div>
          </div>
          <div class="legal-popup-footer">
            © 2025 Micronyx AI Ltd. All rights reserved.<br>
            CMVM License No. 37925 | Commercial Registry: 287190345
          </div>
        </div>
      </div>
        
      <div id="privacidade-popup" class="legal-popup-overlay">
        <div class="legal-popup">
          <div class="legal-popup-header">
            <h2 class="legal-popup-title">Privacy Policy</h2>
            <button class="legal-popup-close" data-close="privacidade-popup">×</button>
          </div>
          <div class="legal-popup-content">
            <p>Last updated: May 7, 2025</p>
            <p>Micronyx AI Ltd., operator of Impulso Invest, is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and protect your personal data when you use our services.</p>
      
            <div class="legal-popup-section">
              <h2>1. Data We Collect</h2>
              <p>We may collect the following types of data:</p>
      
              <h3>1.1 Personal Data</h3>
              <ul>
                <li>Full name</li>
                <li>Email address</li>
                <li>Phone number</li>
                <li>Home address</li>
                <li>Date of birth</li>
                <li>Identification documents (e.g., passport or ID card)</li>
                <li>Financial data (e.g., bank information)</li>
              </ul>
      
              <h3>1.2 Usage Data</h3>
              <ul>
                <li>IP address</li>
                <li>Browser and device type</li>
                <li>Pages visited and time spent</li>
                <li>Clicks and interactions on the website</li>
                <li>Transaction history</li>
              </ul>
            </div>
      
            <div class="legal-popup-section">
              <h2>2. How We Use Your Data</h2>
              <p>We use your personal data for the following purposes:</p>
              <ul>
                <li>Provide and maintain our services</li>
                <li>Process transactions and manage your account</li>
                <li>Comply with legal and regulatory obligations</li>
                <li>Prevent fraud and illegal activities</li>
                <li>Improve our services and develop new features</li>
                <li>Communicate updates, offers, and events</li>
                <li>Personalize your user experience</li>
              </ul>
            </div>
      
            <div class="legal-popup-section">
              <h2>3. Legal Bases for Processing</h2>
              <p>We process your personal data based on the following legal bases:</p>
              <ul>
                <li><strong>Contract performance:</strong> When processing is necessary to perform a contract with you</li>
                <li><strong>Consent:</strong> When you have given us your explicit consent</li>
                <li><strong>Legal obligation:</strong> When processing is necessary to comply with a legal obligation</li>
                <li><strong>Legitimate interests:</strong> When processing is necessary for our legitimate interests without overriding your rights and freedoms</li>
              </ul>
            </div>
      
            <div class="legal-popup-section">
              <h2>4. Sharing Your Data</h2>
              <p>We may share your personal data with:</p>
              <ul>
                <li><strong>Service providers:</strong> Companies that help us deliver our services (e.g., payment processors, hosting providers)</li>
                <li><strong>Business partners:</strong> Companies we collaborate with to offer services</li>
                <li><strong>Regulatory authorities:</strong> When required by law or regulation</li>
                <li><strong>Potential buyers:</strong> In the event of a merger, acquisition, or sale of assets</li>
              </ul>
              <p>We do not sell your personal data to third parties.</p>
            </div>
      
            <div class="legal-popup-section">
              <h2>5. Cookies and Similar Technologies</h2>
              <p>We use cookies and similar technologies to enhance your experience, analyze traffic, and personalize content. You can control the use of cookies through your browser settings. For more information, please read our <a href="#" class="popup-trigger" data-popup="cookies-popup">Cookie Policy</a>.</p>
            </div>
      
            <div class="legal-popup-section">
              <h2>6. Data Security</h2>
              <p>We have implemented technical and organizational measures to protect your personal data from unauthorized access, loss, or alteration. These include encryption, firewalls, and access controls.</p>
            </div>
      
            <div class="legal-popup-section">
              <h2>7. Data Retention</h2>
              <p>We retain your personal data only as long as necessary for the purposes described in this policy, unless a longer retention period is required or permitted by law.</p>
            </div>
      
            <div class="legal-popup-section">
              <h2>8. Your Rights</h2>
              <p>Depending on your location, you may have the following rights regarding your personal data:</p>
              <ul>
                <li>Access your personal data</li>
                <li>Correct inaccurate data</li>
                <li>Delete your personal data</li>
                <li>Restrict or object to processing</li>
                <li>Data portability</li>
                <li>Withdraw your consent</li>
              </ul>
              <p>To exercise these rights, please contact us using the contact information below.</p>
            </div>
      
            <div class="legal-popup-section">
              <h2>9. International Data Transfers</h2>
              <p>Your personal data may be transferred to and processed in countries outside your country of residence. We implement appropriate safeguards to ensure the security of your data in accordance with this policy.</p>
            </div>
      
            <div class="legal-popup-section">
              <h2>10. Changes to This Policy</h2>
              <p>We may update this Privacy Policy from time to time. The current version is always available on our website and includes the date of the last update. We encourage you to review this policy regularly.</p>
            </div>
      
            <div class="legal-popup-section">
              <h2>11. Contact</h2>
              <p>If you have questions about this Privacy Policy or our processing of your personal data, please contact us:</p>
              <p>Av. da Liberdade 110<br>1269-046 Lissabon,<br>Portugal</p>
              <p>Email: <a href="/cdn-cgi/l/email-protection#bdded2d3c9dcc9d2fdd0d4decfd2d3c4c5dcd493ded2d0"><span class="__cf_email__" data-cfemail="b7d4d8d9c3d6c3d8f7daded4c5d8d9cecfd6de99d4d8da">[email�protected]</span></a></p>
            </div>
          </div>
          <div class="legal-popup-footer">
            © 2025 Micronyx AI Ltd. All rights reserved.<br>
            CMVM License No. 37925 | Commercial Registry: 287190345
          </div>
        </div>
      </div>
        
    
<div id="cookies-popup" class="legal-popup-overlay">
    <div class="legal-popup">
      <div class="legal-popup-header">
  <h2 class="legal-popup-title">Cookie Policy</h2>
        <button class="legal-popup-close" data-close="cookies-popup">×</button>
      </div>
      <div class="legal-popup-content">
  <p>Last updated: May 7, 2025</p>
  <p>This Cookie Policy explains how Micronyx AI Ltd., operator of Impulso Invest, uses cookies and similar technologies on our website. We recommend reading this policy to understand what types of cookies we use, what information we collect, and how we use it.</p>
  
        <div class="legal-popup-section">
          <h2>1. What are Cookies?</h2>
          <p>Cookies are small text files stored on your device (computer, tablet, or mobile) when you visit a website. They are commonly used to make websites work more efficiently and to provide information to website owners.</p>
          <p>Cookies allow a website to recognize your device and store certain information about your visit, such as language preferences or login details. This can make your next visit easier and the website more useful to you.</p>
        </div>
  
        <div class="legal-popup-section">
          <h2>2. Types of Cookies We Use</h2>
          <p>We use the following types of cookies on our website:</p>
  
          <h3>2.1 Essential Cookies</h3>
          <p>These cookies are necessary for the basic functionality of the website. They enable navigation and access to secure areas. Without these cookies, many of the services you request cannot be provided.</p>
  
          <h3>2.2 Preference Cookies</h3>
          <p>These cookies remember your previous settings, such as preferred language, region, text size, or other personalized options. They help provide a more tailored experience.</p>
  
          <h3>2.3 Analytics Cookies</h3>
          <p>We use analytics cookies to understand how visitors interact with our website. They help us improve site functionality, measure performance, and evaluate the effectiveness of our marketing campaigns. All information collected by these cookies is aggregated and anonymized.</p>
  
          <h3>2.4 Marketing Cookies</h3>
          <p>These cookies are used to track visitors across websites. The goal is to display relevant and engaging ads for individual users, which are more valuable for publishers and third-party advertisers.</p>
        </div>
  
        <div class="legal-popup-section">
          <h2>3. Specific Cookies We Use</h2>
          <p>The table below lists some of the main cookies we use and their purpose:</p>
  
          <table class="legal-popup-table">
            <thead>
              <tr>
                <th>Cookie Name</th>
                <th>Type</th>
                <th>Purpose</th>
                <th>Duration</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>session_id</td>
                <td>Essential</td>
                <td>Maintains user session state</td>
                <td>Session</td>
              </tr>
              <tr>
                <td>auth_token</td>
                <td>Essential</td>
                <td>User authentication</td>
                <td>30 days</td>
              </tr>
              <tr>
                <td>language_pref</td>
                <td>Preference</td>
                <td>Stores user's preferred language</td>
                <td>1 year</td>
              </tr>
              <tr>
                <td>_ga</td>
                <td>Analytics</td>
                <td>Used by Google Analytics to distinguish users</td>
                <td>2 years</td>
              </tr>
              <tr>
                <td>_gid</td>
                <td>Analytics</td>
                <td>Used by Google Analytics to distinguish users</td>
                <td>24 hours</td>
              </tr>
              <tr>
                <td>_fbp</td>
                <td>Marketing</td>
                <td>Used by Facebook to deliver ads</td>
                <td>3 months</td>
              </tr>
            </tbody>
          </table>
        </div>
  
        <div class="legal-popup-section">
          <h2>4. Third-Party Cookies</h2>
          <p>In addition to our own cookies (first-party cookies), we also use third-party cookies on our website. These are set by a domain other than the website you are visiting. We use third-party cookies for the following purposes:</p>
          <ul>
            <li>Traffic-Analyse (Google Analytics)</li>
            <li>Marketing und Werbung (Facebook, Google Ads)</li>
            <li>Social Media Funktionen (Facebook, Twitter, LinkedIn)</li>
            <li>Sicherheitsverbesserungen und Betrugsprävention</li>
          </ul>
        </div>
  
        <div class="legal-popup-section">
          <h2>5. How to Manage Cookies</h2>
          <p>Most browsers allow you to control cookies through settings or preferences. You can set your browser to refuse all cookies or to notify you when a cookie is being sent. If you refuse cookies, some features of our website may not function properly.</p>
  
          <h3>5.1 Browser Settings</h3>
          <ul>
            <li><strong>Google Chrome:</strong> Menu > Settings > Advanced > Privacy and security > Site settings > Cookies</li>
            <li><strong>Mozilla Firefox:</strong> Menu > Options > Privacy & Security > Cookies and Site Data</li>
            <li><strong>Safari:</strong> Preferences > Privacy > Cookies and Website Data</li>
            <li><strong>Microsoft Edge:</strong> Menu > Settings > Cookies and site permissions > Cookies</li>
          </ul>
  
          <h3>5.2 Opt-out Tools</h3>
          <p>You can also opt-out of certain third-party cookies:</p>
          <ul>
            <li>Google Analytics: <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener noreferrer">https://tools.google.com/dlpage/gaoptout</a></li>
            <li>Facebook: <a href="https://www.facebook.com/settings/?tab=ads" target="_blank" rel="noopener noreferrer">https://www.facebook.com/settings/?tab=ads</a></li>
          </ul>
        </div>
  
        <div class="legal-popup-section">
          <h2>6. Changes to This Policy</h2>
          <p>We may update this Cookie Policy from time to time to reflect changes in our use of cookies or for operational, legal, or regulatory reasons. We encourage you to visit this page regularly to stay informed about our use of cookies and related technologies.</p>
          <p>The date at the top of this policy indicates when it was last updated.</p>
        </div>
  
        <div class="legal-popup-section">
          <h2>7. Contact</h2>
          <p>If you have questions about this Cookie Policy, please contact us:</p>
          <p>Av. da Liberdade 110<br>1269-046 Lissabon,<br>Portugal</p>
          <p>E-Mail: <a href="/cdn-cgi/l/email-protection#4d2e2223392c39220d20242e3f222334352c24632e2220"><span class="__cf_email__" data-cfemail="9bf8f4f5effaeff4dbf6f2f8e9f4f5e2e3faf2b5f8f4f6">[email�protected]</span></a></p>
        </div>
      </div>
      <div class="legal-popup-footer">
        © 2025 Micronyx AI Ltd. All rights reserved.<br>
        CMVM License No. 37925 | Commercial Registry: 287190345
      </div>
    </div>
  </div>



  <div id="risco-popup" class="legal-popup-overlay">
    <div class="legal-popup">
      <div class="legal-popup-header">
        <h2 class="legal-popup-title">Risikohinweis</h2>
        <button class="legal-popup-close" data-close="risco-popup">×</button>
      </div>
      <div class="legal-popup-content">
        <div class="legal-popup-alert">
          <p class="font-bold" style="color: #ff4d4d;">WICHTIG: Trading und Investitionen bergen erhebliche Risiken. Bitte lesen Sie diesen Hinweis sorgfältig, bevor Sie unsere Dienste nutzen.</p>
        </div>
  
        <p>Letzte Aktualisierung: 7. Mai 2025</p>
        <p>Dieser Risikohinweis informiert Nutzer von Impulso Invest über die mit automatisiertem Trading und Investitionen im Allgemeinen verbundenen Risiken. Es ist wichtig, dass Sie diese Risiken vollständig verstehen, bevor Sie unsere Dienste nutzen.</p>
  
        <div class="legal-popup-section">
          <h2>1. Allgemeine Investitionsrisiken</h2>
          <p>Alle Finanzinvestitionen sind mit Risiken verbunden. Der Wert Ihrer Investitionen kann steigen oder fallen, und Sie könnten weniger zurückerhalten als ursprünglich investiert. Frühere Ergebnisse garantieren keine zukünftigen Erträge.</p>
          <ul>
            <li>Finanzmärkte können volatil sein und Preise von Finanzinstrumenten können stark schwanken</li>
            <li>Investitionen unterliegen Markt-, Liquiditäts-, Kredit- und weiteren Risiken</li>
            <li>Wirtschaftliche, politische und soziale Faktoren können die Performance beeinflussen</li>
            <li>Wechselkursschwankungen können sich negativ auf Wert oder Rendite auswirken</li>
          </ul>
        </div>
  
        <div class="legal-popup-section">
          <h2>2. Spezifische Risiken des automatisierten Tradings</h2>
          <p>Automatisiertes Trading und KI-basierte Systeme wie Impulso Invest bringen zusätzliche Risiken mit sich:</p>
          <ul>
            <li><strong>Technische Fehler:</strong> Automatisierte Systeme können Ausfälle haben, z.B. Verbindungsprobleme, Hardware- oder Softwarefehler, Programmierungsfehler</li>
            <li><strong>Algorithmische Beschränkungen:</strong> Algorithmen basieren auf historischen Daten und können sich in neuen Marktbedingungen als ungeeignet erweisen</li>
            <li><strong>Ausführungsgeschwindigkeit:</strong> Verzögerungen können zu abweichenden Preisen führen</li>
            <li><strong>Technologische Abhängigkeit:</strong> Automatisiertes Trading ist abhängig von Infrastruktur, die ausfallen kann</li>
            <li><strong>Overfitting:</strong> Modelle können zu stark an vergangene Daten angepasst sein und in der Zukunft schlecht performen</li>
          </ul>
        </div>
  
        <div class="legal-popup-section">
          <h2>3. Geeignetheit für den Anleger</h2>
          <p>Bevor Sie Impulso Invest verwenden, sollten Sie sorgfältig prüfen, ob dieser Dienst für Sie geeignet ist, unter Berücksichtigung von:</p>
          <ul>
            <li>Ihren Anlagezielen</li>
            <li>Ihrer finanziellen Situation und Ressourcen</li>
            <li>Ihrer Erfahrung und Kenntnis im Bereich Investitionen</li>
            <li>Ihrer Risikotoleranz</li>
            <li>Ihrer Fähigkeit, Verluste zu tragen</li>
          </ul>
          <p>Bei Zweifeln bezüglich der Eignung empfehlen wir die Beratung durch einen unabhängigen Finanzberater.</p>
        </div>
  
        <div class="legal-popup-section">
          <h2>4. Haftungsbeschränkung</h2>
          <p>Micronyx AI Ltd. garantiert keine Gewinne oder spezifische Ergebnisse durch die Nutzung von Impulso Invest. Wir haften nicht für direkte oder indirekte Verluste oder Schäden, die aus der Nutzung unserer Dienste entstehen.</p>
          <p>Durch die Nutzung von Impulso Invest erkennen Sie alle mit automatisiertem Trading und Investitionen verbundenen Risiken an und akzeptieren diese.</p>
        </div>
  
        <div class="legal-popup-section">
          <h2>5. Vorsichtsmaßnahmen</h2>
          <p>Um die Risiken des automatisierten Tradings zu mindern, empfehlen wir:</p>
          <ul>
            <li>Nur Kapital zu investieren, dessen Verlust Sie sich leisten können</li>
            <li>Ihre Investitionen zu diversifizieren</li>
            <li>Die Systemleistung regelmäßig zu überwachen</li>
            <li>Klare Verlustgrenzen festzulegen</li>
            <li>Über die Marktbedingungen informiert zu bleiben</li>
            <li>Mit kleinen Beträgen zu beginnen, bis Sie mit dem System vertraut sind</li>
          </ul>
        </div>
  
        <div class="legal-popup-company-info">
          <h3>Über Micronyx AI Ltd.</h3>
          <p>Micronyx AI ist eine Finanztechnologie, entwickelt von Micronyx AI Ltd., zugelassen und überwacht von der CMVM (Comissão do Mercado de Valores Mobiliários) unter der Lizenznummer 37925.</p>
          <p>Das KI-Tradingsystem arbeitet gemäß EU-Recht und wird unabhängig geprüft.</p>
          <p style="margin-top: 0.75rem;">
            <strong>CMVM Lizenz:</strong> Nr. 37925<br>
            <strong>Handelsregister:</strong> 287190345
          </p>
        </div>
  
        <div class="legal-popup-section">
          <h2>6. Änderungen am Risikohinweis</h2>
          <p>Dieser Risikohinweis kann periodisch aktualisiert werden. Wir empfehlen Ihnen, ihn regelmäßig zu überprüfen, um über die Risiken unserer Dienste informiert zu bleiben.</p>
        </div>
  
        <div class="legal-popup-section">
          <h2>7. Kontakt</h2>
          <p>Bei Fragen zu diesem Risikohinweis können Sie uns kontaktieren unter:</p>
          <p>Av. da Liberdade 110<br>1269-046 Lissabon,<br>Portugal</p>
          <p>Email: <a href="/cdn-cgi/l/email-protection#d0b3bfbea4b1a4bf90bdb9b3a2bfbea9a8b1b9feb3bfbd"><span class="__cf_email__" data-cfemail="cba8a4a5bfaabfa48ba6a2a8b9a4a5b2b3aaa2e5a8a4a6">[email�protected]</span></a></p>
        </div>
      </div>
      <div class="legal-popup-footer">
        © 2025 Micronyx AI Ltd. Alle Rechte vorbehalten.<br>
        CMVM Lizenz Nr. 37925 | Handelsregister: 287190345
      </div>
    </div>
  </div>
    </div><script data-cfasync="false" src="js/email-decode.min.js"></script></body></html>