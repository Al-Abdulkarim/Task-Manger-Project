<?php
require_once 'includes/functions.php';
if (isLoggedIn()) { header("location: dashboard.php"); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager - Organize Your Life</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Additional styles for the enhanced home page */
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #35424a 0%, #1a2a33 100%);
            color: white;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 600px;
        }
        
        .hero-title {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }
        
        .hero-buttons {
            display: flex;
            gap: 15px;
        }
        
       .hero-image {
    position: absolute;
    right: 150px; /* Move it 100px to the left */
    top: 50%;
    transform: translateY(-50%);
    width: 35%; /* Make the image smaller */
    max-width: 400px; /* Reduce max width */
    z-index: 1;
}

        .btn-primary {
            background: #28a745;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-primary:hover {
            background: #218838;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .btn-secondary {
            background: transparent;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            border: 2px solid white;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-secondary:hover {
            background: rgba(255,255,255,0.1);
            transform: translateY(-3px);
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
            padding-bottom: 15px;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            height: 3px;
            background: #28a745;
        }
        
        .features-section {
            padding: 80px 0;
        }
        
        .feature-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            padding: 30px;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        
        .feature-icon {
            font-size: 50px;
            color: #28a745;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .feature-card:hover .feature-icon {
            transform: scale(1.1);
        }
        
        .feature-title {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #35424a;
        }
        
        .feature-description {
            color: #666;
            line-height: 1.6;
            flex-grow: 1;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .how-it-works {
            background: #f9f9f9;
            padding: 80px 0;
        }
        
        .steps {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-top: 50px;
        }
        
        .steps:before {
            content: '';
            position: absolute;
            top: 40px;
            left: 0;
            right: 0;
            height: 3px;
            background: #e0e0e0;
            z-index: 1;
        }
        
        .step {
            text-align: center;
            position: relative;
            z-index: 2;
            width: 25%;
        }
        
        .step-number {
            width: 80px;
            height: 80px;
            background: #28a745;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: 600;
            margin: 0 auto 20px;
        }
        
        .step-title {
            font-weight: 600;
            margin-bottom: 10px;
            color: #35424a;
        }
        
        .testimonials {
            background: linear-gradient(135deg, #35424a 0%, #1a2a33 100%);
            color: white;
            padding: 80px 0;
            position: relative;
        }
        
        .testimonial-container {
            display: flex;
            gap: 30px;
            overflow-x: auto;
            padding: 20px 0;
            scroll-snap-type: x mandatory;
        }
        
        .testimonial {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 30px;
            min-width: 300px;
            scroll-snap-align: start;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
        }
        
        .testimonial-text {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 20px;
            position: relative;
        }
        
        .testimonial-text:before {
            content: '"';
            font-size: 4rem;
            position: absolute;
            top: -20px;
            left: -10px;
            opacity: 0.3;
            font-family: Georgia, serif;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
        }
        
        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
            background: #28a745;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: white;
        }
        
        .author-info {
            line-height: 1.4;
        }
        
        .author-name {
            font-weight: 600;
        }
        
        .author-title {
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        .cta-section {
            background: #28a745;
            color: white;
            padding: 80px 0;
            text-align: center;
        }
        
        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .cta-subtitle {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 30px;
            opacity: 0.9;
        }
        
        .cta-button {
            background: white;
            color: #28a745;
            padding: 15px 40px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        
        .cta-button:hover {
            background: #35424a;
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        
        .stats-section {
            padding: 80px 0;
            text-align: center;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
        }
        
        .stat-item {
            padding: 20px;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: #28a745;
            margin-bottom: 10px;
        }
        
        .stat-label {
            color: #666;
            font-size: 1.1rem;
        }
        
        footer {
            background: #35424a;
            color: white;
            padding: 60px 0 30px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }
        
        .footer-column h3 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .footer-column h3:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: #28a745;
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: #ddd;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .footer-links a:hover {
            color: #28a745;
            padding-left: 5px;
        }
        
        .social-links {
            display: flex;
            gap: 15px;
        }
        
        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            color: white;
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background: #28a745;
            transform: translateY(-3px);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        
        /* Animation for elements */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate {
            animation: fadeInUp 0.6s ease forwards;
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            .hero-image {
                display: none;
            }
            
            .hero-content {
                max-width: 100%;
                text-align: center;
            }
            
            .hero-buttons {
                justify-content: center;
            }
            
            .steps {
                flex-direction: column;
                gap: 40px;
            }
            
            .steps:before {
                display: none;
            }
            
            .step {
                width: 100%;
            }
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.2rem;
            }
            
            .cta-title {
                font-size: 2rem;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Task Manager</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <div class="content">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="hero-content animate">
                    <h1 class="hero-title">Manage Your Tasks with Ease and Efficiency</h1>
                    <p class="hero-subtitle">Stay organized, meet deadlines, and boost your productivity with our intuitive task management platform.</p>
                    <div class="hero-buttons">
                        <a href="register.php" class="btn-primary">
                            <i class="fas fa-user-plus"></i> Get Started
                        </a>
                        <a href="login.php" class="btn-secondary">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </div>
                </div>
                <img src="images/dash.png" alt="Task Manager Dashboard" class="hero-image">
            </div>
        </section>
        
        
        
        <!-- Features Section -->
        <section class="features-section">
            <div class="container">
                <h2 class="section-title">Powerful Features</h2>
                <div class="features-grid">
                    <div class="feature-card animate">
                        <div class="feature-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h3 class="feature-title">Easy Task Management</h3>
                        <p class="feature-description">Create, update, and organize your tasks with our intuitive interface. Set priorities, deadlines, and categories to keep everything in order.</p>
                    </div>
                    
                    <div class="feature-card animate">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="feature-title">Track Progress</h3>
                        <p class="feature-description">Monitor your productivity and track the status of all your tasks in one convenient dashboard. Get insights into your work patterns.</p>
                    </div>
                    
                    <div class="feature-card animate">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3 class="feature-title">Access Anywhere</h3>
                        <p class="feature-description">Access your tasks from any device with an internet connection. Your data syncs automatically, so you're always up to date.</p>
                    </div>
                    
                    <div class="feature-card animate">
                        <div class="feature-icon">
                            <i class="fas fa-bell"></i>
                        </div>
                        <h3 class="feature-title">Reminders</h3>
                        <p class="feature-description">Never miss a deadline with timely reminders. Stay on top of your most important tasks.</p>
                    </div>
                    
                    <div class="feature-card animate">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="feature-title">Team Collaboration</h3>
                        <p class="feature-description">Share tasks and projects with team members. Collaborate efficiently and keep everyone on the same page.</p>
                    </div>
                    
                    <div class="feature-card animate">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="feature-title">Secure & Private</h3>
                        <p class="feature-description">Your data is encrypted and secure. We prioritize your privacy and the security of your information.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- How It Works Section -->
        <section class="how-it-works">
            <div class="container">
                <h2 class="section-title">How It Works</h2>
                <div class="steps">
                    <div class="step animate">
                        <div class="step-number">1</div>
                        <h3 class="step-title">Sign Up</h3>
                        <p>Create your free account in seconds</p>
                    </div>
                    
                    <div class="step animate">
                        <div class="step-number">2</div>
                        <h3 class="step-title">Add Tasks</h3>
                        <p>Create and organize your tasks</p>
                    </div>
                    
                    <div class="step animate">
                        <div class="step-number">3</div>
                        <h3 class="step-title">Track Progress</h3>
                        <p>Monitor completion and deadlines</p>
                    </div>
                    
                    <div class="step animate">
                        <div class="step-number">4</div>
                        <h3 class="step-title">Boost Productivity</h3>
                        <p>Achieve more with better organization</p>
                    </div>
                </div>
            </div>
        </section>
        

        
        <!-- Call to Action Section -->
        <section class="cta-section">
            <div class="container">
                <h2 class="cta-title animate">Ready to Get Organized?</h2>
                <p class="cta-subtitle animate">Join thousands of users who have improved their productivity with our Task Manager. Start for free today!</p>
                <a href="register.php" class="cta-button animate">
                    <i class="fas fa-rocket"></i> Get Started Now
                </a>
            </div>
        </section>
    </div>
    
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Task Manager</h3>
                    <p>A simple and effective way to manage your daily tasks and boost productivity.</p>

                </div>
                
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="#">Features</a></li>
                        <li><a href="#">About Us</a></li>
                    </ul>
                </div>
                
            
                
                <div class="footer-column">
                    <h3>Contact</h3>
                  <ul class="footer-links">
                        <li><i class="fas fa-envelope"></i> az.am.alabdulkarim@gmail.com</li>
                        <li><i class="fas fa-phone"></i> (+966)556934901</li>
                         <li><i class="fas fa-envelope"></i> mohammedalsowelim@gmail.com</li>
                         <li><i class="fas fa-phone"></i> (+966)502774334</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date("Y"); ?> Task Manager | All Rights Reserved</p>
            </div>
        </div>
    </footer>
    
    <script>
        // Simple animation for elements
        document.addEventListener('DOMContentLoaded', function() {
            const animatedElements = document.querySelectorAll('.animate');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, {
                threshold: 0.1
            });
            
            animatedElements.forEach(element => {
                element.style.opacity = 0;
                element.style.transform = 'translateY(20px)';
                element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(element);
            });
        });
    </script>
</body>
</html>