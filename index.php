<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="keywords" content="sport, SportMatch">
    <meta name="author" content="SportMatch">
	<meta name="robots" content="noindex">

    <title>SportMatch</title>

    <link rel="shortcut icon" href="imgs/faviconn.png">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="assets/css/plugins.css">

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body id="home">

	<?php
		require "config.php";
	?>



    <div class="loader-wrap">
        <svg viewBox="0 0 1000 1000" preserveAspectRatio="none">
            <path id="svg" d="M0,1005S175,995,500,995s500,5,500,5V0H0Z"></path>
        </svg>

        <div class="loader-wrap-heading">
            <div class="load-text">
                <span>L</span>
                <span>o</span>
                <span>a</span>
                <span>d</span>
                <span>i</span>
                <span>n</span>
                <span>g</span>
            </div>
        </div>
    </div>


    <div class="progress-wrap cursor-pointer">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>


<nav class="navbar navbar-chang navbar-expand-lg">
    <div class="container position-re">
        <div class="row">
            <div class="col-lg-3 col-6 order1">
                <div class="bord">
                    <a class="logo icon-img-120" href="#">
                        <img class="kep" src="imgs/kepppp.png" alt="logo">
                    </a>
                </div>
            </div>
            <div class="col-lg-6 order3">
                <div class="bg">
                    <div class="full-width">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <?php if (isset($_COOKIE['felhasznalonev'])) : ?>
                                    <a class="nav-link" href="rooms.php?userid=<?= $_COOKIE['felhasznalonev'] ?>">
                                        <span class="rolling-text">Szobák</span>
                                    </a>
                                <?php else : ?>
                                    <a class="nav-link" href="javascript:void(0);" onclick="showLoginMessage()">
                                        <span class="rolling-text">Szobák</span>
                                    </a>
                                <?php endif; ?>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="events.php"><span class="rolling-text">Események</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="rolunk.php"><span class="rolling-text">Rólunk</span></a>
                            </li>
                            <li class="nav-item">
                                <?php if (isset($_COOKIE['felhasznalonev'])) : ?>
                                    <a class="nav-link" href="logout.php?logout=1"><span class="rolling-text">Kijelentkezés</span></a>
                                <?php else : ?>
                                    <a class="nav-link" href="login.php"><span class="rolling-text">Bejelentkezés</span></a>
                                <?php endif; ?>
                            </li>
                            <li class="nav-item">
                                <?php if (isset($_COOKIE['felhasznalonev'])) : ?>
                                    <a class="nav-link" href="profil.php?userid=<?= $_COOKIE['felhasznalonev'] ?>">
                                        <span class="rolling-text">Profilom</span>
                                    </a>
                                <?php else : ?>
                                    <a class="nav-link" href="regist.php">
                                        <span class="rolling-text">Regisztráció</span>
                                    </a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6 order2">
                <div class="bord d-flex justify-content-end">
                    <?php if (isset($_COOKIE['felhasznalonev'])) : ?>
                        <!-- Felhasználónév hamburger menü ikonnal -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="profil.php?userid=<?= $_COOKIE['felhasznalonev'] ?>">
                                        <p>Bejelentkezve:</p><?= $_COOKIE['felhasznalonev'] ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php else : ?>
                        <a href="login.php" class="szoveg">SportMatch</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</nav>


    <main>


        <section class="min-box pt-40">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-10">

                        <div class="min-sec current" id="tab-1">

                            <div class="hero-min pt-80 pb-80">
                                <div class="cont">
                                    <h1>SportMatch</h1>
                                    <div class="d-flex align-items-center mt-30">
                                        <?php if(isset($_COOKIE['felhasznalonev']) && $_COOKIE['email'] == 'admin@gmail.com') :?>
										<div class="mr-15">
                                            <div class="feat">
													<a href="admin.php?userid=<?= $_COOKIE['felhasznalonev'] ?>"><span>Admin</span>	</a>						
                                            </div>
											
                                        </div>
										<?php else : ?>
										
										

										<?php endif; 
										
										
										?>
                                        <div class="mr-15">
                                            <?php if (isset($_COOKIE['felhasznalonev'])) : ?>
                                            <a href="rooms.php?userid=<?= $_COOKIE['felhasznalonev'] ?>">
                                                <?php else : ?>
                                                <a href="javascript:void(0);" onclick="showLoginMessage()">
                                                <?php endif; ?>
                                                <div class="feat">
                                                    <p><span>Szobák</span></p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text mt-30">
                                        <p>A SportMatch egy olyan oldal, amely lehetővé teszi mindenki számára a sporttársak találását a mindennapokban. 
                                        Regisztrációt követően már el is kezdheti minden felhasználó a match-ek keresését.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
							
                        <h2 style="text-align: center">Mai hírek</h2>
						<div _ngcontent-serverapp-c53="" class="content-container content-element content-type-article layout-element" data-content-length="3" data-calculated-desktop-width="9">
							<div _ngcontent-serverapp-c53="" class="row horizontal" style="background-color: transparent;">
								<div _ngcontent-serverapp-c53="" class="col-12 column-border-color-undefined col-lg-4">
									<article _ngcontent-serverapp-c143="" nso-article-card="" _nghost-serverapp-c75="" class="article-card medium style-FeaturedImgTitleLead">
										<nso-article-card-link-wrapper _ngcontent-serverapp-c75="" _nghost-serverapp-c74="">
										<a _ngcontent-serverapp-c74="" href="/legiosok/2024/02/gulacsi-peter-varja-a-talalkozast-neuerrel-es-bizik-a-bayern-legyozeseben">
											<div _ngcontent-serverapp-c75="" class="article-card-link">
												<figure _ngcontent-serverapp-c75="" class="article-card-thumbnail-box">
													<nso-article-card-link-wrapper _ngcontent-serverapp-c75="" _nghost-serverapp-c74="">
													<a _ngcontent-serverapp-c74="" href="https://www.nemzetisport.hu/legiosok/2024/02/gulacsi-peter-varja-a-talalkozast-neuerrel-es-bizik-a-bayern-legyozeseben">
														<img _ngcontent-serverapp-c75="" loading="lazy" class="article-card-thumbnail" src="https://cdn.nemzetisport.hu/2024/02/4l5cv7_iIP_LpL2ZnOWliFxPhSVM00VArAwhHYctkEw/fill/700/394/no/1/aHR0cHM6Ly9jbXNjZG4uYXBwLmNvbnRlbnQucHJpdmF0ZS9jb250ZW50LzZiNjQ5YTVlOGQxMjQ4YmJiNGU3ODY4NjBkYmMzNDJk.jpg" alt="">
														<h5 _ngcontent-serverapp-c75="" class="article-card-title">Gulácsi Péter várja a találkozást Neuerrel, és bízik a Bayern legyőzésében</h5><br>
													</a></nso-article-card-link-wrapper>
												</figure>
												
													
											</div>
										</a></nso-article-card-link-wrapper>
									</article>
								</div>
								<div _ngcontent-serverapp-c53="" class="col-12 column-border-color-undefined col-lg-4">
									<article _ngcontent-serverapp-c143="" nso-article-card="" _nghost-serverapp-c75="" class="article-card medium style-FeaturedImgTitleLead">
										<nso-article-card-link-wrapper _ngcontent-serverapp-c75="" _nghost-serverapp-c74="">
											<a _ngcontent-serverapp-c74="" href="/tenisz/2024/02/marozsan-nem-birt-a-masodik-kiemelttel-dohaban">
												<div _ngcontent-serverapp-c75="" class="article-card-link"><figure _ngcontent-serverapp-c75="" class="article-card-thumbnail-box">
													<nso-article-card-link-wrapper _ngcontent-serverapp-c75="" _nghost-serverapp-c74="">
														<a _ngcontent-serverapp-c74="" href="https://www.nemzetisport.hu/tenisz/2024/02/marozsan-nem-birt-a-masodik-kiemelttel-dohaban">
															<img _ngcontent-serverapp-c75="" loading="lazy" class="article-card-thumbnail" src="https://cdn.nemzetisport.hu/2024/02/PwATJ-6hvLUZiw-Aw9X1Hu3f0s1VlMF4EjxC2QCdEp4/fill/700/394/no/1/aHR0cHM6Ly9jbXNjZG4uYXBwLmNvbnRlbnQucHJpdmF0ZS9jb250ZW50Lzg0MzYyMWYxMjlmNjQ1MDBiNDM3YjAxOWVmN2VlMmRl.jpg" alt="">
															<h5 _ngcontent-serverapp-c75="" class="article-card-title">Marozsán két szoros szettben kikapott Hacsanovtól Dohában</h5>
														</a>
															</nso-article-card-link-wrapper></figure>
															
															
												</div>
											</a></nso-article-card-link-wrapper>
									</article>
								</div>
								<div _ngcontent-serverapp-c53="" class="col-12 column-border-color-undefined col-lg-4">
									<article _ngcontent-serverapp-c143="" nso-article-card="" _nghost-serverapp-c75="" class="article-card medium style-FeaturedImgTitleLead">
										<nso-article-card-link-wrapper _ngcontent-serverapp-c75="" _nghost-serverapp-c74="">
										<a _ngcontent-serverapp-c74="" href="/magyar-valogatott/2024/02/eves-berletet-lehet-valtani-a-labdarugo-valogatott-merkozeseire">
											<div _ngcontent-serverapp-c75="" class="article-card-link">
												<figure _ngcontent-serverapp-c75="" class="article-card-thumbnail-box"><nso-article-card-link-wrapper _ngcontent-serverapp-c75="" _nghost-serverapp-c74="">
													<a _ngcontent-serverapp-c74="" href="https://www.nemzetisport.hu/magyar-valogatott/2024/02/eves-berletet-lehet-valtani-a-labdarugo-valogatott-merkozeseire">
														<img _ngcontent-serverapp-c75="" loading="lazy" class="article-card-thumbnail" src="https://cdn.nemzetisport.hu/2024/02/VuBad42oQvWgE4ydP0JSkfodOflHZHqfKAjiTBbhxvg/fill/700/394/no/1/aHR0cHM6Ly9jbXNjZG4uYXBwLmNvbnRlbnQucHJpdmF0ZS9jb250ZW50L2E4NjI4ZTljNTY4NTQxMjQ5OTFlNzU2NDA1NDg3MTM5.jpg" alt="">
														<h5 _ngcontent-serverapp-c75="" class="article-card-title">Éves bérletet lehet váltani a labdarúgó-válogatott mérkőzéseire</h5>
													</a>
													</nso-article-card-link-wrapper>
													<i _ngcontent-serverapp-c75="" class="icon icon-play icon-video-play"></i>
												</figure>
												
												
											</div>
										</a>
										</nso-article-card-link-wrapper>
									</article>
								</div>
							</div>
						</div>
						<div _ngcontent-serverapp-c53="" class="content-container content-element content-type-article layout-element" data-content-length="3" data-calculated-desktop-width="9">
							<div _ngcontent-serverapp-c53="" class="row horizontal" style="background-color: transparent;">
								<div _ngcontent-serverapp-c53="" class="col-12 column-border-color-undefined col-lg-4">
									<article _ngcontent-serverapp-c143="" nso-article-card="" _nghost-serverapp-c75="" class="article-card medium style-FeaturedImgTitleLead">
									<nso-article-card-link-wrapper _ngcontent-serverapp-c75="" _nghost-serverapp-c74="">
										<a _ngcontent-serverapp-c74="" href="/nemet-labdarugas/2024/02/mar-hivatalos-eldolt-thomas-tuchel-sorsa-a-bayern-munchennel">
											<div _ngcontent-serverapp-c75="" class="article-card-link">
												<figure _ngcontent-serverapp-c75="" class="article-card-thumbnail-box">
													<nso-article-card-link-wrapper _ngcontent-serverapp-c75="" _nghost-serverapp-c74="">
														<a _ngcontent-serverapp-c74="" href="https://www.nemzetisport.hu/nemet-labdarugas/2024/02/mar-hivatalos-eldolt-thomas-tuchel-sorsa-a-bayern-munchennel">
															<img _ngcontent-serverapp-c75="" loading="lazy" class="article-card-thumbnail" src="https://cdn.nemzetisport.hu/2024/02/yHNuUKPnEF-j5UIcDvrHMHGWzSQgnlILj0vgfPNGlU4/fill/700/394/no/1/aHR0cHM6Ly9jbXNjZG4uYXBwLmNvbnRlbnQucHJpdmF0ZS9jb250ZW50L2M5Yjc4YzcyNDA5NTQwZjRiYWExN2YxNTBmZTMxZDA0.jpg" alt="">
															<h5 _ngcontent-serverapp-c75="" class="article-card-title">Már hivatalos, eldőlt Thomas Tuchel sorsa a Bayern Münchennél</h5>
														</a>
														</nso-article-card-link-wrapper></figure>
														
															
											</div>
										</a>
										</nso-article-card-link-wrapper>
									</article>
								</div>
								<div _ngcontent-serverapp-c53="" class="col-12 column-border-color-undefined col-lg-4">
                                    <article _ngcontent-serverapp-c143="" nso-article-card="" _nghost-serverapp-c75="" class="article-card medium style-FeaturedImgTitleLead">
                                        <nso-article-card-link-wrapper _ngcontent-serverapp-c75="" _nghost-serverapp-c74="">
                                            <a _ngcontent-serverapp-c74="" href="https://www.nemzetisport.hu/atletika/2024/04/szabadidosport-futounnep-a-fovaros-sziveben">
                                                <div _ngcontent-serverapp-c75="" class="article-card-link">
                                                    <figure _ngcontent-serverapp-c75="" class="article-card-thumbnail-box">
                                                        <nso-article-card-link-wrapper _ngcontent-serverapp-c75="" _nghost-serverapp-c74="">
                                                            <a _ngcontent-serverapp-c74="" href="https://www.nemzetisport.hu/atletika/2024/04/szabadidosport-futounnep-a-fovaros-sziveben">
                                                                <img _ngcontent-serverapp-c75="" loading="lazy" class="article-card-thumbnail" src="https://cdn.nemzetisport.hu/2024/04/QFywfauS2vBiOTyU2UnoXOI4rjvWAIw5TOZPMEzmtPk/fill/1347/758/no/1/aHR0cHM6Ly9jbXNjZG4uYXBwLmNvbnRlbnQucHJpdmF0ZS9jb250ZW50LzdiMzE4NjEyMzJhYTRiZjRhNGU3ZTRiMTNiZDI3Njhj.jpg" alt="">
                                                                <h5 _ngcontent-serverapp-c75="" class="article-card-title">Szabadidősport: futóünnep a főváros szívében</h5>
                                                            </a>
                                                        </nso-article-card-link-wrapper>
                                                    </figure>
                                                </div>
                                            </a>
                                        </nso-article-card-link-wrapper>
                                    </article>
                                </div>
								<div _ngcontent-serverapp-c53="" class="col-12 column-border-color-undefined col-lg-4">
                                    <article _ngcontent-serverapp-c143="" nso-article-card="" _nghost-serverapp-c75="" class="article-card medium style-FeaturedImgTitleLead">
                                        <nso-article-card-link-wrapper _ngcontent-serverapp-c75="" _nghost-serverapp-c74="">
                                            <a _ngcontent-serverapp-c74="" href="https://www.nemzetisport.hu/bajnokok-ligaja/2024/04/bl-igy-nyerte-meg-a-real-madrid-a-manchester-city-elleni-tizenegyesparbajt-hattersztori">
                                                <div _ngcontent-serverapp-c75="" class="article-card-link">
                                                    <figure _ngcontent-serverapp-c75="" class="article-card-thumbnail-box">
                                                        <nso-article-card-link-wrapper _ngcontent-serverapp-c75="" _nghost-serverapp-c74="">
                                                            <a _ngcontent-serverapp-c74="" href="https://www.nemzetisport.hu/bajnokok-ligaja/2024/04/bl-igy-nyerte-meg-a-real-madrid-a-manchester-city-elleni-tizenegyesparbajt-hattersztori">
                                                                <img _ngcontent-serverapp-c75="" loading="lazy" class="article-card-thumbnail" src="https://cdn.nemzetisport.hu/2024/04/smP9aDmyj6JrJBM9AZKtu9qQ8cLh3DbuUqIdTTsPZcY/fill/700/394/no/1/aHR0cHM6Ly9jbXNjZG4uYXBwLmNvbnRlbnQucHJpdmF0ZS9jb250ZW50LzNjMmVjMTVjZmQzNjQ3ZmFiYzdlZjQyYWU3YzQ1M2Rm.jpg" alt="">
                                                                <h5 _ngcontent-serverapp-c75="" class="article-card-title">BL: így nyerte meg a Real Madrid a Manchester City elleni tizenegyespárbajt – háttérsztori</h5><br>
                                                            </a>
                                                        </nso-article-card-link-wrapper>
                                                    </figure>
                                                </div>
                                            </a>
                                        </nso-article-card-link-wrapper>
                                    </article>
                                </div>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </section>

        <div class="footer"><span>SportMatch©</span></div>


    </main>

    <script>
        function showLoginMessage() {
            alert("A tovább lépéshez be kell jelentkezni!");
            window.location.href = "login.php";
        }
    </script>
	
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/jquery-migrate-3.4.0.min.js"></script>

    <script src="assets/js/plugins.js"></script>

    <script src="assets/js/scripts.js"></script>

</body>

</html>