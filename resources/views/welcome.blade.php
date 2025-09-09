<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Larafit - Gestión Inteligente de Gimnasios</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
        }

        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 0 20px;
            animation: fadeInUp 1s ease-out;
        }

        .logo {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .tagline {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            font-weight: 300;
            opacity: 0.95;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 3rem;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(45deg, #ff6b6b, #ff8e53);
            color: white;
            box-shadow: 0 10px 30px rgba(255, 107, 107, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(255, 107, 107, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .features {
            padding: 80px 20px;
            background: #f8fafc;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            color: #2d3748;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 1rem;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .feature-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #2d3748;
        }

        .feature-description {
            color: #718096;
            line-height: 1.6;
        }

        .stats {
            background: linear-gradient(135deg, #2d3748 0%, #4a5568 100%);
            color: white;
            padding: 60px 20px;
            text-align: center;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: #4ecdc4;
            display: block;
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-top: 0.5rem;
        }

        .testimonials {
            padding: 80px 20px;
            background: white;
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        .testimonial-card {
            background: #f7fafc;
            padding: 2rem;
            border-radius: 15px;
            border-left: 4px solid #4ecdc4;
        }

        .testimonial-text {
            font-style: italic;
            margin-bottom: 1rem;
            color: #4a5568;
        }

        .testimonial-author {
            font-weight: 600;
            color: #2d3748;
        }

        .cta-section {
            background: linear-gradient(135deg, #ff6b6b 0%, #4ecdc4 100%);
            color: white;
            padding: 80px 20px;
            text-align: center;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .cta-description {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }

        .auth-links {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 10;
            display: flex;
            gap: 1rem;
        }

        .auth-link {
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 25px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .auth-link:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .floating-element {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        @media (max-width: 768px) {
            .logo {
                font-size: 2.5rem;
            }

            .tagline {
                font-size: 1.2rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 300px;
            }

            .auth-links {
                position: relative;
                top: auto;
                right: auto;
                justify-content: center;
                margin-top: 2rem;
            }
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero">
        <div class="floating-elements">
            <div class="floating-element"></div>
            <div class="floating-element"></div>
            <div class="floating-element"></div>
        </div>

        @if (Route::has('login'))
            <div class="auth-links">
                @auth
                    <a href="{{ url('/dashboard') }}" class="auth-link">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="auth-link">Iniciar Sesión</a>
                @endauth
            </div>
        @endif

        <div class="hero-content">
            <h1 class="logo">Larafit</h1>
            <p class="tagline">La plataforma más completa para la gestión inteligente de tu gimnasio</p>

            <div class="cta-buttons">
                <a href="#features" class="btn btn-primary">Descubre más</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <div class="container">
            <h2 class="section-title">Características principales</h2>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">💪</div>
                    <h3 class="feature-title">Gestión de Miembros</h3>
                    <p class="feature-description">Administra fácilmente los perfiles de tus miembros, membresías, pagos
                        y seguimiento de progreso en una sola plataforma.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3 class="feature-title">Analíticas Avanzadas</h3>
                    <p class="feature-description">Obtén insights detallados sobre el rendimiento de tu gimnasio,
                        ocupación, ingresos y tendencias de uso.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🗓️</div>
                    <h3 class="feature-title">Programación de Clases</h3>
                    <p class="feature-description">Organiza horarios de clases, reservas, instructores y capacidades con
                        nuestro sistema de calendario integrado.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">💳</div>
                    <h3 class="feature-title">Control de Pagos</h3>
                    <p class="feature-description">Sistema completo de facturación, control de pagos, recordatorios
                        automáticos y reportes financieros.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🔧</div>
                    <h3 class="feature-title">Mantenimiento de Equipos</h3>
                    <p class="feature-description">Programa y rastrea el mantenimiento de equipos para garantizar la
                        seguridad y funcionamiento óptimo.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3 class="feature-title">App Móvil</h3>
                    <p class="feature-description">Accede a todas las funciones desde cualquier dispositivo con nuestra
                        aplicación móvil responsive.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-number">500+</span>
                    <span class="stat-label">Gimnasios activos</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">50K+</span>
                    <span class="stat-label">Miembros gestionados</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">24/7</span>
                    <span class="stat-label">Soporte técnico</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">Lo que dicen nuestros clientes</h2>

            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <p class="testimonial-text">"Larafit ha revolucionado la forma en que administramos nuestro
                        gimnasio. La interfaz es intuitiva y las funcionalidades son exactamente lo que necesitábamos."
                    </p>
                    <p class="testimonial-author">- María González, FitZone Gym</p>
                </div>

                <div class="testimonial-card">
                    <p class="testimonial-text">"Desde que implementamos Larafit, hemos visto un aumento del 40% en la
                        eficiencia de nuestras operaciones diarias. Altamente recomendado."</p>
                    <p class="testimonial-author">- Carlos Martínez, PowerFit Center</p>
                </div>

                <div class="testimonial-card">
                    <p class="testimonial-text">"El soporte técnico es excepcional y las actualizaciones constantes
                        mantienen la plataforma siempre al día con nuestras necesidades."</p>
                    <p class="testimonial-author">- Ana López, Elite Fitness</p>
                </div>

                <div class="testimonial-card">
                    <p class="testimonial-text">"La funcionalidad de análisis nos ha permitido tomar decisiones
                        informadas que han mejorado significativamente la experiencia de nuestros miembros."</p>
                    <p class="testimonial-author">- Javier Ramírez, StrongBody Gym</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="demo" class="cta-section">
        <div class="container">
            <h2 class="cta-title">¿Listo para transformar tu gimnasio?</h2>
            <p class="cta-description">Únete a cientos de gimnasios que ya confían en Larafit para optimizar sus
                operaciones</p>

            <div class="cta-buttons">
                <a href="mailto:contacto@larafit.com" class="btn btn-secondary">Contactar ventas</a>
            </div>
        </div>
    </section>

    <script>
        // Smooth scrolling para los enlaces internos
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Animación de aparición de elementos al hacer scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Aplicar animación a las tarjetas de características
        document.querySelectorAll('.feature-card').forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = `all 0.6s ease ${index * 0.1}s`;
            observer.observe(card);
        });
    </script>
</body>

</html>
