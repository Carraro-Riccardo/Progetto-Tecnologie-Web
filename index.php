<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/phone.css">
    <script src="script.js"></script>
    <title>GagGym</title>
</head>
<body>
    <header class="main">
        <nav id="nav-principale" aria-label="navigazione">
        <div class="container">
            <div class="logo-title-holder">
                <a href="index.php" class="logo-holder">
                    <img class="logo" src="./assets/imgs/logo.png" alt="Homepage">
                </a>
                <h1 class="site-title">GagGym</h1>
            </div>
        </div>
            <button id="hamburger" aria-expanded="false">
                <span>Menu</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" aria-hidden="true">
                    <path d="M4 16h16v-2H4v2zm0-5h16v-2H4v2zm0-7v2h16V4H4z" />
                </svg>
            </button>
            <div class="main-nav">
                <ul class="container">
                    <li>
                    <a href="" aria-current="page">Home</a>
                    </li>
                    <li>
                    <a href="#">Login/Register</a>
                    </li>
                    <li>
                    <a href="#">Corsi</a>
                    </li>
                    <li>
                    <a href="#">Macchinari</a>
                    </li>
                    <li>
                    <a href="#">Chi siamo</a>
                    </li>
                    <li>
                    <a href="#">Contattaci</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <ul id="cards-container">
        <li>
            <a id="corsi" href="section1.html" class="card">
                <div class="description">
                    <span>Corsi</span>
                    <p>Diventa anche tu Richard Watterson</p>
                </div>
            </a>
        </li>

        <li>
            <a id="macchinari" href="section1.html" class="card">
                <div class="description">
                    <span>Macchinari</span>
                    <p>Le migliori macchine in circolazione</p>
                </div>
            </a>
        </li>

        <li>
            <a id="chiSiamo" href="section1.html" class="card">
                <div class="description">
                    <span>Chi siamo</span>
                    <p>Pipperi del quartiere</p>
                </div>
            </a>
        </li>
    </ul>
</body>
</html>