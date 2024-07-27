<style>
    @import url('https://fonts.googleapis.com/css2?family=Aboreto&family=Cormorant:ital,wght@0,300;1,300&family=Montserrat:wght@300&family=Poppins:wght@200;300&family=Unbounded&display=swap');

    /*------------Header------------*/
    .wrapper {
        overflow-x: hidden;
        margin-left: 5%;
        margin-right: 5%;
    }

    header {
        height: 20vh;
    }

    .head-top {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .head-bottom {
        width: 100%;
        text-align: center;
    }

    .logo {
        font-family: 'Unbounded', cursive;
        font-size: 28px;
        color: #219ebc;
        font-weight: bold;
    }

    .logo:hover {
        color: #fb8500;
        transition: 0.5s;
        cursor: pointer;
    }

    ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    li {
        font-size: 1.5rem;
        display: inline-block;
    }

    i {
        color: #fb8500;
        font-size: 24px;
    }

    i:hover {
        color: #219ebc;
    }

    .head-span {
        font-size: 20px;
    }

    .cta {
        border: none;
        background: none;
    }

    .cta span {
        font-family: 'Poppins', sans-serif;
        padding-bottom: 7px;
        letter-spacing: 4px;
        font-size: 16px;
        text-transform: uppercase;
    }

    .hover-underline-animation {
        position: relative;
        color: #161616;
        padding-bottom: 20px;
    }

    .hover-underline-animation:after {
        content: '';
        position: absolute;
        width: 90%;
        transform: scaleX(0);
        height: 2px;
        bottom: 0;
        left: 0;
        background-color: #fb8500;
        transform-origin: bottom right;
        transition: transform 0.25s ease-out;
    }

    .cta:hover .hover-underline-animation:after {
        transform: scaleX(1.08);
        transform-origin: bottom left;
    }

    .button {
        outline: none;
        cursor: pointer;
        border: none;
        margin: 0;
        padding: 15% 30% 15% 30%;
        font-family: 'Poppins', sans-serif;
        font-size: 18px;
        position: relative;
        display: inline-block;
        border-radius: 500px;
        overflow: hidden;
        background-color: #219ebc;
        color: #fafafa;
    }

    .button .span {
        position: relative;
        z-index: 10;
        transition: color 0.4s;
    }

    .button:hover .span {
        color: #000000;
    }

    .button::before,
    .button::after {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
    }

    .button::before {
        content: '';
        background: #000000;
        width: 120%;
        left: -10%;
        transform: skew(30deg);
        transition: transform 0.4s cubic-bezier(0.3, 1, 0.8, 1);
    }

    .button:hover::before {
        transform: translate3d(100%, 0, 0);
    }

    .input {
        font-family: 'Poppins', sans-serif;
        color: #05060f;
        width: 40%;
        height: 44px;
        border-radius: 0.5rem;
        padding: 0 1rem;
        margin: 1rem;
        border: 1px solid #00000046;
        font-size: 1rem;
        background-color: transparent;
    }

    a {
        text-decoration: none;
    }

    i:hover {
        transition: 0.3s;
    }
</style>
<script src="https://kit.fontawesome.com/05eb19a694.js" crossorigin="anonymous"></script>
<header class="wrapper">
    <div class="head-top">
        <a href="../Main_Page/index.php">
            <div class="logo" title="Logo Ebookly">Ebookly<span style="color:#FB8500;">.</span></div>
        </a>
        <input name="wyszukiwanie" placeholder="Wpisz czego szukasz..." type="text" class="input" title="Wyszukiwanie">
        <ul>
            <li title="Ulubione"><a href="../page_in_build/page_in_build.php"><button class="cta"><span><i
                                class="fa-solid fa-heart"></i> Polubione</span></button>
                </a></li>
            <li title="Koszyk"><a href="../Koszyk/index.php"><button class="cta"><span><i
                                class="fa-solid fa-cart-shopping"></i>
                            Koszyk</span></button>
                </a></li>
            <li title="Konto">
                <?php if (isset($_SESSION['zalogowany'])): ?>
                    <a href="../Log_Reg/konto.php"><button class="cta"><span><i class="fa-solid fa-user"></i> Moje
                                Konto</span></button></a>
                <?php else: ?>
                    <a href="../Log_Reg/form_logowanie.php"><button class="cta"><span><i class="fa-solid fa-user"></i>
                                Zaloguj się</span></button></a>
                <?php endif; ?>
            </li>
        </ul>
    </div>
    <section class="head-bottom">
        <ul>
            <li title="Ebooki"><button class="cta" style="margin-left: 20px;"><span
                        class="hover-underline-animation">Ebooki</span></button></li>
            <li title="Audiobooki"><button class="cta"><span
                        class="hover-underline-animation ">Audiobooki</span></button></li>
            <li title="Eprasa"><button class="cta"><span class="hover-underline-animation">Eprasa</span></button>
            </li>
            <li title="Nowości"><button class="cta"><span class="hover-underline-animation">Nowości</span></button>
            </li>
            <li title="Blog"><button class="cta"><span class="hover-underline-animation">Blog</span></button></li>
            <li title="Promocje"><button class="cta"><span class="hover-underline-animation">Promocje</span></button>
            </li>
            <li title="O nas"><button class="cta"><span class="hover-underline-animation">O nas</span></button></li>
        </ul>
    </section>
</header>