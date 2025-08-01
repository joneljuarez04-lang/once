<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Una página especial para celebrar el Día de la Novia">
    <title>Feliz Día de la Novia</title>
    <style>
        :root {
            --primary-color: #0040ff;
            --secondary-color: #4da0ff;
            --bg-color: #000;
            --text-glow: 0 0 10px var(--primary-color);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background-color: var(--bg-color);
            color: var(--primary-color);
            font-family: 'Courier New', monospace, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            overflow: hidden;
            position: relative;
        }
        
        .container {

            text-align: center;
            position: relative;
            z-index: 10;
            padding: 20px;
            max-width: 800px;
        }
        
        h1 {
            font-size: clamp(2rem, 5vw, 3.5rem);
            text-shadow: var(--text-glow), 0 0 20px var(--primary-color);
            animation: glitch 1s infinite alternate, pulseText 2s infinite;
            margin-bottom: 20px;
            line-height: 1.2;
        }
        
        p {
            font-size: clamp(1.2rem, 3vw, 1.8rem);
            margin: 15px 0;
            animation: flicker 3s infinite;
            text-shadow: 0 0 5px var(--primary-color);
        }
        
        .date {
            font-weight: bold;
            color: var(--secondary-color);
        }
        
        .heart {
            font-size: clamp(3rem, 8vw, 5rem);
            animation: pulse 1.5s infinite, float 3s ease-in-out infinite;
            display: inline-block;
            margin: 20px 0;
            cursor: pointer;
            transition: transform 0.3s, filter 0.3s;
        }
        
        .heart:hover {
            transform: scale(1.2);
            filter: drop-shadow(0 0 15px var(--primary-color));
        }
        
        .firework {
            position: absolute;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            box-shadow: 0 0 10px 2px var(--primary-color);
            animation: firework-explode 1s ease-out forwards;
            opacity: 0;
            z-index: 5;
        }
        
        @keyframes glitch {
            0%, 100% { 
                transform: translate(0); 
                text-shadow: var(--text-glow), 0 0 20px var(--primary-color); 
            }
            25% { 
                transform: translate(-3px, 3px); 
                text-shadow: 0 0 15px var(--primary-color), 0 0 25px var(--primary-color), 0 0 30px var(--primary-color); 
            }
            50% { 
                transform: translate(3px, -3px); 
                text-shadow: 0 0 20px var(--primary-color), 0 0 30px var(--primary-color); 
            }
            75% { 
                transform: translate(-3px, 3px); 
                text-shadow: 0 0 25px var(--primary-color), 0 0 35px var(--primary-color); 
            }
        }
        
        @keyframes flicker {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.3); }
            100% { transform: scale(1); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
        
        @keyframes pulseText {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.9; }
        }
        
        .binary-char {
            position: absolute;
            color: rgba(255, 0, 0, 0.4);
            font-size: 1rem;
            user-select: none;
            z-index: 1;
            animation: fall linear infinite;
        }
        
        @keyframes fall {
            to { transform: translateY(100vh); }
        }
        
        @keyframes firework-explode {
            0% {
                transform: translate(var(--firework-x), var(--firework-y));
                opacity: 1;
                width: 5px;
                height: 5px;
            }
            100% {
                transform: translate(var(--firework-x), var(--firework-y)) scale(20);
                opacity: 0;
                width: 1px;
                height: 1px;
            }
        }
        
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: var(--primary-color);
            opacity: 0.7;
            animation: confetti-fall 5s linear forwards;
            z-index: 2;
        }
        
        @keyframes confetti-fall {
            0% {
                transform: translateY(-100px) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }
        
        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }
            
            h1 {
                font-size: 2rem;
            }
            
            p {
                font-size: 1.2rem;
            }
            
            .heart {
                font-size: 3rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 id="hacker-text"></h1>
        <p class="date">01 de Agosto</p>
        <div class="heart" id="heart" >❤</div>
        <p id="message">Para mi chikis hermosa ❤️</p>
        <!--<p id="message">Para la persona más especial ❤️</p> -->
    </div>

    <!-- Elemento de audio oculto -->
    <audio id="bgMusic" loop style="display: none;">
        <source src="audio1.mp3" type="audio/mpeg">
        Tu navegador no soporta el elemento de audio.
    </audio>

    <script>
        function createBinaryRain() {
            const chars = "jye";
            const fontSize = 30;
            const columns = Math.floor(window.innerWidth / fontSize);
            const drops = Array(columns).fill(1);
            
            const container = document.createElement('div');
            container.style.position = 'fixed';
            container.style.top = '0';
            container.style.left = '0';
            container.style.width = '100%';
            container.style.height = '100%';
            container.style.pointerEvents = 'none';
            container.style.zIndex = '1';
            document.body.appendChild(container);
            
            const elementPool = [];
            const maxElements = 200;
            
            function getBinaryElement() {
                if (elementPool.length > 0) {
                    return elementPool.pop();
                }
                const element = document.createElement('span');
                element.className = 'binary-char';
                return element;
            }
            
            function render() {
                const children = Array.from(container.children);
                children.forEach(child => {
                    const top = parseFloat(child.style.top || '0');
                    if (top > window.innerHeight) {
                        container.removeChild(child);
                        elementPool.push(child);
                    }
                });
                
                for (let i = 0; i < drops.length; i++) {
                    if (Math.random() > 0.7) {
                        const char = chars[Math.floor(Math.random() * chars.length)];
                        const drop = getBinaryElement();
                        drop.textContent = char;
                        drop.style.left = `${i * fontSize}px`;
                        drop.style.top = `${drops[i] * fontSize}px`;
                        drop.style.animationDuration = `${Math.random() * 2 + 1}s`;
                        
                        if (!drop.parentNode) {
                            container.appendChild(drop);
                        }
                        
                        drops[i]++;
                        
                        if (drops[i] * fontSize > window.innerHeight && Math.random() > 0.975) {
                            drops[i] = 0;
                        }
                    }
                }
            }
            
            const interval = setInterval(render, 50);
            
            window.addEventListener('resize', () => {
                clearInterval(interval);
                container.innerHTML = '';
                elementPool.length = 0;
                createBinaryRain();
            });
        }
        
        function typeWriter(element, text, speed = 100) {
            let i = 0;
            element.textContent = '';
            
            function type() {
                if (i < text.length) {
                    const randomChar = String.fromCharCode(Math.random() * 25 + 65);
                    element.textContent = text.substring(0, i) + randomChar;
                    
                    setTimeout(() => {
                        element.textContent = text.substring(0, i + 1);
                        i++;
                        type();
                    }, speed);
                } else {
                    setTimeout(() => {
                        element.style.animation = 'glitch 1s infinite alternate, pulseText 2s infinite';
                    }, 500);
                }
            }
            
            type();
        }
        
        function setupHeartEffect() {
            const heart = document.getElementById('heart');
            const messages = [
                "❤️ TE AMO MUCHO NIÑA HERMOSA ❤️",
                "ERES ESPECIAL EN MI CORAZÓN 💖",
                "FELIZ DÍA AMORCITA 😍",
                "PARA TI CON MUCHÍSIMO AMOR 💕",
                "ERES MI RAZÓN DE SER 🌟",
                "MI CORAZÓN ES TUYO 💘"
            ];
            
            let currentIndex = 0;
            let isAnimating = false;
            
            heart.addEventListener('click', () => {
                if (isAnimating) return;
                isAnimating = true;
                
                createFirework(heart.offsetLeft + heart.offsetWidth/2, heart.offsetTop + heart.offsetHeight/2);
                
                heart.style.transform = 'scale(1.5)';
                heart.style.opacity = '0.5';
                
                setTimeout(() => {
                    currentIndex = (currentIndex + 1) % messages.length;
                    heart.textContent = messages[currentIndex];
                    heart.style.transform = 'scale(1)';
                    heart.style.opacity = '1';
                    isAnimating = false;
                    
                    createConfetti();
                }, 300);
            });
            
            setInterval(() => {
                if (!isAnimating && Math.random() > 0.7) {
                    heart.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        heart.style.transform = 'scale(1)';
                    }, 200);
                }
            }, 3000);
        }
        
        function createFirework(x, y) {
            const colors = ['#004cff', '#4d8eff', '#99e7ff', '#cce0ff'];
            
            for (let i = 0; i < 10; i++) {
                const firework = document.createElement('div');
                firework.className = 'firework';
                firework.style.setProperty('--firework-x', `${x + (Math.random() - 0.5) * 50}px`);
                firework.style.setProperty('--firework-y', `${y + (Math.random() - 0.5) * 50}px`);
                firework.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                firework.style.animationDuration = `${0.5 + Math.random() * 0.5}s`;
                
                document.body.appendChild(firework);
                
                setTimeout(() => {
                    if (firework.parentNode) {
                        firework.parentNode.removeChild(firework);
                    }
                }, 1000);
            }
        }
        
        function createConfetti() {
            const colors = ['#0033ff', '#4d94ff', '#8cc6ff', '#ccecff', '#ccecff'];
            
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = `${Math.random() * 100}vw`;
                confetti.style.width = `${5 + Math.random() * 5}px`;
                confetti.style.height = `${5 + Math.random() * 5}px`;
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animationDuration = `${3 + Math.random() * 2}s`;
                confetti.style.animationDelay = `${Math.random() * 0.5}s`;
                
                document.body.appendChild(confetti);
                
                setTimeout(() => {
                    if (confetti.parentNode) {
                        confetti.parentNode.removeChild(confetti);
                    }
                }, 5000);
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {

            createBinaryRain();
            typeWriter(document.getElementById('hacker-text'), '¡FELIZ DÍA DE LA NOVIA!');
            setupHeartEffect();
            
            setTimeout(createConfetti, 1500);
        });



        // Tu código JavaScript existente...
        
        // Agrega esto al final de tu script
        
        document.addEventListener('DOMContentLoaded', function() {
            // Tu código existente...
            
            // Intenta reproducir música automáticamente después de interacción
            function startMusic() {
                const music = document.getElementById('bgMusic');
                music.volume = 0.3; // Volumen bajo
                
                // Los navegadores modernos requieren interacción del usuario
                const playPromise = music.play();
                
                if (playPromise !== undefined) {
                    playPromise.catch(error => {
                        // Si falla el autoplay, intenta reproducir después del primer clic
                        document.body.addEventListener('click', function firstInteraction() {
                            music.play();
                            document.body.removeEventListener('click', firstInteraction);
                        }, { once: true });
                    });
                }
            }
            
            // Intenta iniciar la música al cargar
            startMusic();
            
            // También puedes iniciarla al hacer clic en el corazón
            document.getElementById('heart').addEventListener('click', function() {
                document.getElementById('bgMusic').play();
            });
        });



    </script>
</body>
</html>