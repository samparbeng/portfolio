<?php
include 'config.php';
include 'includes/error_handling.php';

$portfolioItems = [];

if ($stmt = $conn->prepare('SELECT id, title, image FROM portfolio_items ORDER BY created_at DESC')) {
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $portfolioItems[] = $row;
        }
        $stmt->close();
    } else {
        logError("Failed to execute query: " . $stmt->error);
        displayError("An error occurred while fetching portfolio items. Please try again later.");
    }
} else {
    logError("Failed to prepare query: " . $conn->error);
    displayError("An error occurred while fetching portfolio items. Please try again later.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samuel A. - Full Stack Developer</title>
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Open+Sans:wght@400;500;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body id="top">
    <header class="header" data-header>
        <div class="container">
            <a href="#">
                <h1 class="logo">Samuel A.</h1>
            </a>
            <button class="nav-toggle-btn" aria-label="Toggle Menu" data-nav-toggle-btn>
                <ion-icon name="menu-outline" class="menu-icon"></ion-icon>
                <ion-icon name="close-outline" class="close-icon"></ion-icon>
            </button>
            <nav class="navbar container">
                <ul class="navbar-list">
                    <li><a href="#home" class="navbar-link" data-nav-link>Home</a></li>
                    <li><a href="#about" class="navbar-link" data-nav-link>About</a></li>
                    <li><a href="#portfolio" class="navbar-link" data-nav-link>Portfolio</a></li>
                    <li><a href="#skills" class="navbar-link" data-nav-link>Skills</a></li>
                    <li><a href="#contact" class="navbar-link" data-nav-link>Contact</a></li>
                    <li><a href="#blog" class="navbar-link" data-nav-link>Blog</a></li>
                    <li><a href="#" class="btn btn-primary">Download Resume</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <article>
            <section class="hero" id="home">
                <div class="container">
                    <div class="hero-banner">
                        <img src="./assets/images/work-setup-minimal.jpg" width="800" height="864" loading="lazy" alt="Ethan's Photo" class="img-cover">
                        <div class="elem elem-1">
                            <p class="elem-title">12</p>
                            <p class="elem-text">Years of Success</p>
                        </div>
                        <div class="elem elem-2">
                            <p class="elem-title">55+</p>
                            <p class="elem-text">Projects Completed</p>
                        </div>
                        <div class="elem elem-3">
                            <ion-icon name="trophy"></ion-icon>
                        </div>
                    </div>
                    <div class="hero-content">
                        <h2 class="hero-title">
                            <span>Hello I'm</span>
                            <strong>Samuel A.</strong>Full Stack Developer
                        </h2>
                        <p class="hero-text">Adipisicing elit. Neque nulla voluptatum eos repellat deserunt nesciunt tempore porro totam.</p>
                        <div class="btn-group">
                            <a href="#contact" class="btn btn-primary blue">Get a Quote</a>
                            <a href="#about" class="btn">About Me</a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section about" id="about">
                <div class="container">
                    <figure class="about-banner">
                        <img src="./assets/images/about-banner.jpg" width="800" height="652" loading="lazy" alt="Ethan's Photo" class="img-cover">
                        <img src="./assets/images/absolute-image.jpg" width="800" height="717" loading="lazy" alt="Ethan's Photo" class="abs-img">
                        <div class="abs-icon abs-icon-1">
                            <ion-icon name="logo-css3"></ion-icon>
                        </div>
                        <div class="abs-icon abs-icon-2">
                            <ion-icon name="logo-javascript"></ion-icon>
                        </div>
                        <div class="abs-icon abs-icon-3">
                            <ion-icon name="logo-angular"></ion-icon>
                        </div>
                    </figure>
                    <div class="about-content">
            <p class="section-subtitle">I'm a Developer</p>
            <h2 class="h2 section-title">I Develop Application that Help People</h2>
            <p class="section-text">Dliquip ex ea commo do conse namber onequa ute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatu epteur sint occaecat cupidatat</p>
            <p class="section-text">Krnon proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis</p>
            <a href="#portfolio" class="btn btn-primary blue">View Portfolio</a>
            <div class="social-links">
                <a href="https://github.com/samparbeng" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
                <a href="https://www.linkedin.com/in/yourprofile" target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                <a href="https://www.facebook.com/kwadwoamparbeng" target="_blank" title="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="https://twitter.com/yourprofile" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>
</section>


            <section class="section portfolio" id="portfolio">
                <div class="container">
                    <p class="section-subtitle">Portfolio</p>
                    <h2 class="h2 section-title">My Amazing Works</h2>
                    <p class="section-text">Dliquip ex ea commo do conse namber onequa ute irure dolor in reprehen derit in voluptate</p>
                    <ul class="portfolio-list">
                        <?php if (!empty($portfolioItems)): ?>
                            <?php foreach ($portfolioItems as $item): ?>
                                <li>
                                    <a href="portfolio-item.php?id=<?php echo htmlspecialchars($item['id']); ?>" class="portfolio-card" style="background-image: url('uploads/<?php echo htmlspecialchars($item['image']); ?>')">
                                        <div class="card-content">
                                            <h3 class="h3 card-title"><?php echo htmlspecialchars($item['title']); ?></h3>
                                            <span class="btn-link">
                                                <span>View Project</span>
                                                <ion-icon name="arrow-forward"></ion-icon>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No portfolio items found.</p>
                        <?php endif; ?>
                    </ul>
                </div>
            </section>

            <section class="section skills" id="skills">
                <div class="container">
                    <p class="section-subtitle">My Skills</p>
                    <h2 class="h2 section-title">I Develop Skills Regularly</h2>
                    <p class="section-text">Dliquip ex ea commo do conse namber onequa ute irure dolor in reprehen derit in voluptate</p>
                    <ul class="skills-list">
                        <li class="skills-item">
                            <div class="wrapper" style="width: 95%">
                                <h3 class="skills-title">CSS</h3>
                                <data class="skills-data" value="95">95%</data>
                            </div>
                            <div class="skills-progress-box">
                                <div class="skills-progress" style="width: 95%"></div>
                            </div>
                        </li>
                        <li class="skills-item">
                            <div class="wrapper" style="width: 75%">
                                <h3 class="skills-title">JavaScript</h3>
                                <data class="skills-data" value="75">75%</data>
                            </div>
                            <div class="skills-progress-box">
                                <div class="skills-progress" style="width: 75%"></div>
                            </div>
                        </li>
                        <li class="skills-item">
                            <div class="wrapper" style="width: 80%">
                                <h3 class="skills-title">Angular</h3>
                                <data class="skills-data" value="80">80%</data>
                            </div>
                            <div class="skills-progress-box">
                                <div class="skills-progress" style="width: 80%"></div>
                            </div>
                        </li>
                        <li class="skills-item">
                            <div class="wrapper" style="width: 90%">
                                <h3 class="skills-title">HTML</h3>
                                <data class="skills-data" value="90">90%</data>
                            </div>
                            <div class="skills-progress-box">
                                <div class="skills-progress" style="width: 90%"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>

            <section class="section contact" id="contact">
                <div class="container">
                    <div class="contact-card">
                        <p class="card-subtitle">Don't be shy</p>
                        <h2 class="h2 section-title">Drop Me a Line</h2>
                            <div class="wrapper">
                                <form action="" class="contact-form">
                                    <input type="text" name="name" placeholder="Name" required class="contact-input">
                                    <input type="email" name="email" placeholder="Email" required class="contact-input">
                                    <textarea name="message" placeholder="Message" required class="contact-input"></textarea>
                                    <button type="submit" class="btn-submit">Submit Message</button>
                                </form>
                                <ul class="contact-list">
                                    <li class="contact-item">
                                    <div class="contact-icon">
                                        <ion-icon name="location"></ion-icon>
                                     </div>
                            <div>
                    <h3 class="contact-item-title">Address</h3>

                    <address class="contact-item-link">
                      East Keswick Rd, Philadelphia,PA 19154 US
                    </address>
                  </div>

                </li>

                <li class="contact-item">

                  <div class="contact-icon">
                    <ion-icon name="mail"></ion-icon>
                  </div>

                  <div>
                    <h3 class="contact-item-title">Email</h3>

                    <a href="mailto:hello@ethan.com" class="contact-item-link">kojoamparbeng@gmail.com</a>
                  </div>

                </li>

                <li class="contact-item">

                  <div class="contact-icon">
                    <ion-icon name="call"></ion-icon>
                  </div>

                  <div>
                    <h3 class="contact-item-title">Phone</h3>

                    <a href="tel:+12676600965" class="contact-item-link">+1 (267) 660-0965</a>
                  </div>

                </li>

              </ul>

            </div>

          </div>

        </div>
      </section>
           
            <section class="section blog" id="blog">
                <div class="container">
                    <p class="section-subtitle">Latest Blog</p>
                    <h2 class="h2 section-title">Read My Blog & Tips</h2>
                    <p class="section-text">Dliquip ex ea commo do conse namber onequa ute irure dolor in reprehen derit in voluptate</p>
                    <ul class="blog-list">
                        <!-- Blog items will go here -->
                    </ul>
                </div>
            </section>
        </article>
    </main>

    <footer class="footer">
        <div class="container">
            <ul class="footer-list">
                <li><a href="#" class="footer-link">Home</a></li>
                <li><a href="#" class="footer-link">About</a></li>
                <li><a href="#" class="footer-link">Portfolio</a></li>
                <li><a href="#" class="footer-link">Skills</a></li>
                <li><a href="#" class="footer-link">Contact</a></li>
                <li><a href="#" class="footer-link">Blog</a></li>
                <li><a href="admin\login.php"class="footer-link">Admin</a></li>
            </ul>
            <p class="footer-text">© 2024 Samuel Amp. All Rights Reserved.</p>
        </div>
    </footer>

    <a href="#top" class="go-top" data-go-top>
        <ion-icon name="chevron-up"></ion-icon>
    </a>

    <script src="./assets/js/script.js"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@latest/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@latest/dist/ionicons/ionicons.js"></script>
</body>
</html>
