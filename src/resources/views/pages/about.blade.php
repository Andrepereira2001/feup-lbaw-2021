@extends('layouts.static')

@section('content')

<section id="about">
    <div class="grid">
        <div class="grid-container">
        <a class="item-amarelo"><img alt="Yellow Box" src={{ asset('img/yellow_project_box.png') }}></a>
        <a class="item-rosa"><img alt="Pink Box" src={{ asset('img/pink_project_box.png') }}></a>
        <a class="item-azul"><img alt="Blue Box" src={{ asset('img/blue_project_box.png') }}></a>
        <a class="item-verde"><img alt="Green Box" src={{ asset('img/green_project_box.png') }}></a>
        <h1 class="title">About Us</h1>
        </div>
    </div>
    <div class="about-info">
        <span class="title2"> Project Management has never been easier </span>
            <div class="team-members">
                <div class="row">
                    <div class="team-member">
                        <img class="member-photo" alt= "André Pereira" src={{asset("img/andre.png")}}>
                        <span>André Pereira</span>
                        <a href="https://www.linkedin.com/in/andrepereira2001/"><img class="lkin" src={{asset("img/linkedin.png")}}></a>
                    </div>
                    <div class="team-member">
                        <img class="member-photo" alt= "Beatriz Santos" src={{asset("img/beatriz.png")}}>
                        <span>Beatriz Santos</span>
                        <a href="https://www.linkedin.com/in/beatriz-lopes-dos-santos-bb8853148/"><img class="lkin" src={{asset("img/linkedin.png")}}></a>
                    </div>
                </div>
                <div class="row">
                    <div class="team-member">
                        <img class="member-photo" alt= "Matilde Oliveira" src={{asset("img/matilde.png")}}>
                        <span>Matilde Oliveira</span>
                        <a href="https://www.linkedin.com/in/matildejoliveira/"><img class="lkin" src={{asset("img/linkedin.png")}}></a>
                    </div>
                    <div class="team-member">
                        <img class="member-photo" alt= "Ricardo Ferreira" src={{asset("img/ricardo.png")}}>
                        <span>Ricardo Ferreira</span>
                        <a href="https://www.linkedin.com/in/ricardo-ferreira-36a17a1bb/"><img class="lkin" src={{asset("img/linkedin.png")}}></a>
                    </div>
                </div>
                <span class="text">At toEaseManage we belive that there is a better way to manage your life and work projects.<br>
                    A more valuable, secure way where our customers are earned rather than bought. We’re obssessively passionated about it,
                    and our mission is to help you achieve your desired organization.<br> We focus on keeping every thing simple for you.
                    It’s one of the least understood and least transparent aspects of great management,  and we see that as an opportunity.<br>
                    We’re excited to simplify the life of everyone through our website, organization and community!
                </span>
        </div>
    </div>

</section>

@endsection
