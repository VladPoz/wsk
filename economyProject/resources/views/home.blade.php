@extends('layout.main')

@section("page__title")
    FinHub Home
@endsection

@section("page__content")
    <section class="hero" id="hero">
        <img src="{{asset('./media/img/bg.jpg')}}" alt="">
        <div class="container">
            <div class="hero__container">

                <h1>Финансы и <span class="gradient__font">бизнес</span></h1>
                <p>Быстро и удобно проводить анализ своего бизнеса, отслеживать ключевые показатели, понимать текущую ситуацию и принимать обоснованные управленческие решения.</p>
                <a href="{{route('dashboard')}}"><button class="btn">Начать</button> | Начните прямо сейчас</a>
            </div>
        </div>
    </section>
    <section class="info" id="info">
        <div class="container">
            <div class="info__container">
                <h2>Интересные факты</h2>
                <ul>
                    <li>
                        <h3><span class="gradient__font">01</span></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo ipsum laboriosam quas sed. Eaque, rem.</p>
                    </li>
                    <li>
                        <h3><span class="gradient__font">02</span></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo ipsum laboriosam quas sed. Eaque, rem.</p>
                    </li>
                    <li>
                        <h3><span class="gradient__font">03</span></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo ipsum laboriosam quas sed. Eaque, rem.</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>
@endsection
