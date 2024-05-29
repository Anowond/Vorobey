<x-default-layout title='Acceuil'>

    <section class="main container mt-5 fs-5 tf2">
        <div class="row"></div>
        <h1 class="text-center py-2">Welcome to my website !</h1>
        <p class="text-center">What is good everyone, it's your russian guy Vorobey here, and today i present to
            you....</br>
            <span class="fw-bolder tf2">MY OWN WEBSITE !</span>
        </p>
        <p class="py-2 text-center">In this one, you will be able to find all my work, such as :</p>
    </section>

    <section class="my-5">
        <div class="container ">
            <div class="row align-items-strech">
                <div class="col mb-4">
                    <div class="card mb-3">
                        <img src="/img/tf2-camera.jpg" class="image-fluid rounded-0"
                            alt="a picture of a medic from team fortress 2 game, holding a camera">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="card-title text-center py-3">TF2 videos</h5>
                                <p class="card-text">It's in this section that you can see my videos on Team Fortress 2, if
                                    you want to see cheaters getting clapped or see me attempt some challenges, click on
                                    this button!</p>
                                <a class="btn btn-card" href="{{ route('videos') }}">My videos</a>
                      </div>

                </div>
            </div>
        </div>
    </section>

</x-default-layout>
