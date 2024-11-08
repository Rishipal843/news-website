<?php
  
  session_start();

  if(!isset($_SESSION['name'])){
    echo "you are logged out";
     header('location:login.php'); 
  }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News website</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="material-icons">menu</i>
        </label>
        
        <div class="main-nav container flex">
            <a href="#" class="company-logo">
                <img src="./images/logo2.png" alt="company-logo" width="200px">
            </a> 
                    
            <div class="nav-links">
                <ul class="flex">
                    <li class="hover-link nav-item"> <a href="" onClick="reload()">Home</a></li>       
                    <li class="hover-link nav-item" id="science" onclick="onNavItemClick('science')">Science</li>
                    <li class="hover-link nav-item" id="health" onclick="onNavItemClick('health')">Health</li>
                    <li class="hover-link nav-item" id="sports" onclick="onNavItemClick('sports')">Sports</li>
                    <li class="hover-link nav-item"><a href="#about-section">About</a></li>   
                    <li class="hover-link nav-item"><div class="contact-btn flex">
                        <a href="logout.php" class="logout-button">Logout</a>
                    </div> </li>
                </ul>  
                  
            </div>
                    
            
            
          
        </div>
        

        <div class="search-bar flex">
            <input id="search-text" type="text" class="news-input" placeholder="e.g Science">
            <button id="search-button" class="search-button">Search</button>
        </div>

    </nav>
   
   

    <main>
        <div class="card-container container flex" id="card-container">
          
        </div>
    </main>

    <template id="template-news-card">  
        <div class="card">
        <div class="card-header">
            <img src="https://via.placeholder.com/400x200" alt="news-image" id="news-img">
        </div>
        <div class="card-content">
            <h3 id="news-title">This is the Title</h3>
            <h6 class="news-source" id="news-source">End Gadget 01/07/2024</h6>
            <p class="news-desc" id="news-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic rem quos aperiam, explicabo voluptatum animi modi quisquam facere. Repudiandae, itaque!</p>
        </div>
        </div>
    </template>
   
    <footer id="about-section">
        <div class="main-foot">
            <div class="about">
            <div><h1>About Us</h1></div>
            <p>Welcome to our news platform, powered by News API—a powerful and flexible tool that enables developers to access a wealth of news articles from various sources worldwide. News API provides real-time data from thousands of reputable news outlets, allowing users to stay informed about the latest trends and developments across multiple categories including technology, health, sports, science, and more.</p>
        </div>
        <div class="footer-image">
            <img src="./images/logo2.png" alt="this is image" width="300px"></div>
        </div>
    </footer>

    <script src="./javascript/script.js"></script>
</body>
</html>