<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スタイリッシュなアニメーション</title>
    <style>
        /* ベーススタイル */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #111;
            color: #fff;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        header {
            text-align: center;
            margin-bottom: 6rem;
            opacity: 0;
            transform: translateY(-50px);
            animation: fadeInDown 1s ease-out forwards;
        }

        h1 {
            font-size: 4rem;
            margin-bottom: 1rem;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        p.subtitle {
            font-size: 1.5rem;
            color: #aaa;
            margin-bottom: 2rem;
        }

        /* カード要素 */
        .cards {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2rem;
            width: 300px;
            cursor: pointer;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card:nth-child(1) {
            animation: fadeInUp 0.5s ease-out 0.2s forwards;
        }

        .card:nth-child(2) {
            animation: fadeInUp 0.5s ease-out 0.4s forwards;
        }

        .card:nth-child(3) {
            animation: fadeInUp 0.5s ease-out 0.6s forwards;
        }

        .card:hover {
            transform: translateY(-10px) scale(1.05);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            display: inline-block;
            transition: transform 0.3s ease;
        }

        .card:hover .icon {
            transform: rotate(360deg) scale(1.2);
        }

        .card h2 {
            margin-bottom: 1rem;
            color: #4facfe;
        }

        .card p {
            color: #ccc;
            line-height: 1.6;
        }

        /* ボタン */
        .cta-button {
            margin-top: 4rem;
            text-align: center;
            opacity: 0;
            animation: pulse 1s ease-out 1s forwards;
        }

        button {
            background: linear-gradient(45deg, #4facfe, #00f2fe);
            border: none;
            color: white;
            padding: 1rem 2rem;
            font-size: 1.2rem;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        button:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        button::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }

        button:hover::after {
            animation: ripple 1s ease-out;
        }

        /* 背景アニメーション */
        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, #4facfe33, #00f2fe33);
            animation: float 15s infinite;
        }

        .circle:nth-child(1) {
            width: 300px;
            height: 300px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .circle:nth-child(2) {
            width: 400px;
            height: 400px;
            top: 60%;
            left: 70%;
            animation-delay: -5s;
            background: linear-gradient(45deg, #fd1d1d33, #833ab433);
        }

        .circle:nth-child(3) {
            width: 200px;
            height: 200px;
            top: 40%;
            left: 40%;
            animation-delay: -10s;
            background: linear-gradient(45deg, #fcb04533, #fd1d1d33);
        }

        /* アニメーションキーフレーム */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(100px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 1;
            }
            20% {
                transform: scale(25, 25);
                opacity: 1;
            }
            100% {
                opacity: 0;
                transform: scale(40, 40);
            }
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
            100% {
                transform: translateY(0) rotate(360deg);
            }
        }

        /* スクロールアニメーション */
        .scroll-animation {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease-out;
        }

        .scroll-animation.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* レスポンシブデザイン */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }

            .cards {
                flex-direction: column;
                align-items: center;
            }

            .card {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</head>
<body>
    <div class="background">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>

    <div class="container">
        <header>
            <h1>スタイリッシュな体験</h1>
            <p class="subtitle">モダンなアニメーションとトランジション効果</p>
        </header>

        <div class="cards">
            <div class="card">
                <div class="icon">✨</div>
                <h2>村上</h2>
                <p>お転婆だがしっかり者という両極端な性格</p>
            </div>
            <div class="card">
                <div class="icon">🎨</div>
                <h2>手嶋</h2>
                <p>タンタンと仕事をこなし、どんな仕事も問題なくこなす</p>
            </div>
            <div class="card">
                <div class="icon">🚀</div>
                <h2>山下</h2>
                <p>すべて柔軟に対応し、ハイパフォーマンスルーキー</p>
            </div>
        </div>

        <div class="cta-button">
            <button id="action-button">もっと見る</button>
        </div>

        <div class="scroll-section" style="margin-top: 10rem;">
            <div class="scroll-animation">
                <h2 style="text-align: center; margin-bottom: 2rem;">スクロールして発見する</h2>
                <p style="text-align: center; max-width: 600px; margin: 0 auto; color: #aaa;">
                    このページをスクロールすると、さらに多くの要素がアニメーションします。
                    スクロールベースのアニメーションは、ユーザーエンゲージメントを高め、
                    コンテンツの発見をより魅力的にします。
                </p>
            </div>
        </div>
    </div>

    <script>
        // ボタンクリックアニメーション
        document.getElementById('action-button').addEventListener('click', function() {
            this.innerHTML = "読み込み中...";
            this.style.background = "linear-gradient(45deg, #833ab4, #fd1d1d)";

            setTimeout(() => {
                this.innerHTML = "完了!";
                this.style.background = "linear-gradient(45deg, #00c853, #69f0ae)";
            }, 1500);
        });

        // スクロールアニメーション
        const scrollElements = document.querySelectorAll('.scroll-animation');

        const elementInView = (el, scrollOffset = 100) => {
            const elementTop = el.getBoundingClientRect().top;
            return (
                elementTop <= (window.innerHeight || document.documentElement.clientHeight) - scrollOffset
            );
        };

        const displayScrollElement = (element) => {
            element.classList.add('active');
        };

        const handleScrollAnimation = () => {
            scrollElements.forEach((el) => {
                if (elementInView(el, 100)) {
                    displayScrollElement(el);
                }
            });
        };

        window.addEventListener('scroll', () => {
            handleScrollAnimation();
        });

        // 初期表示用
        handleScrollAnimation();
    </script>
</body>
</html>
