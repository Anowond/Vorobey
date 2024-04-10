<x-default-layout title='Acceuil'>

    <section class="main container mt-5 fs-5">
        <div class="row"></div>
        <h1 class="text-center py-2">Welcome to my website !</h1>
        <p class="roboto text-center">What is good everyone, it's your russian guy Vorobey here, and today i present to
            you....</br>
            <span class="fw-bolder tf2">MY OWN WEBSITE !</span>
        </p>
        <p class="py-2 roboto text-center">In this one, you will be able to find all my work, such as :</p>
    </section>

    <section class="my-5">
        <div class="container">
            <div class="row align-items-strech">
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100 text-light">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title text-center py-3">TF2 videos</h5>
                            <p class="card-text">It's in this section that you can see my videos on Team Fortress 2, if
                                you want to see cheaters getting clapped or see me attempt some challenges, click on
                                this button!</p>
                            <a class="btn btn-card" href="{{ route('videos') }}">My videos</a>
                        </div>
                        <img src="/img/tf2-camera.jpg" class="card-img-bottom card-img img-fluid rounded-0"
                            alt="a picture of a medic from team fortress 2 game, holding a camera">
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100 text-light">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title text-center py-3">SoundCloud Sounds</h5>
                            <p class="card-text">Yes ! I also do music! I even use some of my samples for my
                                videos.</br>
                                So if you are looking for some good music while destroying some crying cheaters, click
                                on dat button below</p>
                            <button class="btn btn-card ">My Music</button>
                        </div>
                        <img src="/img/tf2-music.png" class="card-img-bottom card-img img-fluid rounded-0"
                            alt="...">
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100 text-light">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title text-center py-3">Shop</h5>
                            <p class="card-text">Have you ever dreamed of having your own Police hacker cap? Or sip a
                                good vodka from a Vorobey mug? So click on dat button and make your dreams come true!
                            </p>
                            <a class="btn btn-card" href="{{ route('shop') }}">My shop</a>
                        </div>
                        <img src="/img/tf2-shop.jpg" class="card-img-bottom card-img img-fluid rounded-0"
                            alt="...">
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-default-layout>
