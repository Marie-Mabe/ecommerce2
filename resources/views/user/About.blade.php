@extends('user.navigation.layout')

@section('title', 'À propos de nous')

@section('content')
<style>
    /* Styles généraux */
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #3498db;
        --accent-color: #e74c3c;
        --light-color: #f8f9fa;
        --dark-color: #343a40;
    }
    
    .hero {
        background-color: var(--primary-color);
        color: white;
        padding: 5rem 0;
        margin-bottom: 3rem;
    }
    
    .hero h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    /* Section Pourquoi nous choisir */
    .why-choose-section {
        padding: 5rem 0;
    }
    
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: var(--primary-color);
        position: relative;
        display: inline-block;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        width: 50%;
        height: 3px;
        background-color: var(--secondary-color);
        bottom: -10px;
        left: 0;
    }
    
    .feature {
        margin-bottom: 2rem;
    }
    
    .feature .icon {
        width: 60px;
        height: 60px;
        background-color: var(--light-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }
    
    .feature .icon img {
        width: 30px;
        height: 30px;
    }
    
    .feature h3 {
        font-size: 1.25rem;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }
    
    .img-wrap {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    /* Section Équipe */
    .team-section {
        padding: 5rem 0;
        background-color: var(--light-color);
    }
    
    .team-member {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .team-member img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 1.5rem;
        border: 5px solid white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .team-member h3 {
        font-size: 1.5rem;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }
    
    .team-member .position {
        color: var(--secondary-color);
        font-weight: 500;
        margin-bottom: 1rem;
        display: block;
    }
    
    /* Section Témoignages */
    .testimonial-section {
        padding: 5rem 0;
        background-color: white;
    }
    
    .testimonial-block {
        background-color: var(--light-color);
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .testimonial-block blockquote {
        font-style: italic;
        color: var(--dark-color);
        position: relative;
    }
    
    .testimonial-block blockquote:before,
    .testimonial-block blockquote:after {
        content: '"';
        font-size: 2rem;
        color: var(--secondary-color);
        opacity: 0.5;
    }
    
    .author-info {
        margin-top: 2rem;
    }
    
    .author-pic img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 1rem;
        border: 3px solid var(--secondary-color);
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .hero h1 {
            font-size: 2.5rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .why-choose-section, 
        .team-section,
        .testimonial-section {
            padding: 3rem 0;
        }
    }
</style>

<!-- Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1>À propos de nous</h1>
                <p class="lead">Découvrez l'histoire et les valeurs qui nous animent</p>
            </div>
        </div>
    </div>
</div>

<!-- Why Choose Us Section -->
<div class="why-choose-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="section-title">Pourquoi nous choisir</h2>
                <p class="mb-5">Nous nous engageons à fournir des produits de qualité supérieure avec un service client exceptionnel.</p>

                <div class="row">
                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="{{ asset('images/truck.svg') }}" alt="Livraison rapide">
                            </div>
                            <h3>Livraison rapide</h3>
                            <p>Recevez vos commandes en un temps record, partout dans le pays.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="{{ asset('images/bag.svg') }}" alt="Facile à acheter">
                            </div>
                            <h3>Achat facile</h3>
                            <p>Une expérience d'achat simplifiée et intuitive.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="{{ asset('images/support.svg') }}" alt="Support 24/7">
                            </div>
                            <h3>Support 24/7</h3>
                            <p>Notre équipe est disponible à tout moment pour vous aider.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="{{ asset('images/return.svg') }}" alt="Retours faciles">
                            </div>
                            <h3>Retours sans souci</h3>
                            <p>Politique de retour simple et sans complications.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="img-wrap">
                    <img src="{{ asset('images/why-choose-us-img.jpg') }}" alt="Notre équipe" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Team Section -->
<div class="team-section bg-light py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title">Notre Équipe</h2>
                <p>Rencontrez les passionnés qui font de E-Market une expérience exceptionnelle</p>
            </div>
        </div>

        <div class="row">
            <!-- Membre 1 -->
            <div class="col-12 col-md-6 col-lg-3 text-center mb-5">
                <div class="team-member">
                    <img src="{{ asset('images/person_1.jpg') }}" alt="Lawson Arnold" class="img-fluid">
                    <h3>Lawson Arnold</h3>
                    <span class="position">PDG & Fondateur</span>
                    <p>Visionnaire derrière E-Market avec plus de 15 ans d'expérience.</p>
                </div>
            </div>

            <!-- Membre 2 -->
            <div class="col-12 col-md-6 col-lg-3 text-center mb-5">
                <div class="team-member">
                    <img src="{{ asset('images/person_2.jpg') }}" alt="Jeremy Walker" class="img-fluid">
                    <h3>Jeremy Walker</h3>
                    <span class="position">Directeur Technique</span>
                    <p>Expert en solutions e-commerce et expérience utilisateur.</p>
                </div>
            </div>

            <!-- Membre 3 -->
            <div class="col-12 col-md-6 col-lg-3 text-center mb-5">
                <div class="team-member">
                    <img src="{{ asset('images/person_3.jpg') }}" alt="Patrik White" class="img-fluid">
                    <h3>Patrik White</h3>
                    <span class="position">Directeur Marketing</span>
                    <p>Spécialiste des stratégies digitales et de croissance.</p>
                </div>
            </div>

            <!-- Membre 4 -->
            <div class="col-12 col-md-6 col-lg-3 text-center mb-5">
                <div class="team-member">
                    <img src="{{ asset('images/person_4.jpg') }}" alt="Kathryn Ryan" class="img-fluid">
                    <h3>Kathryn Ryan</h3>
                    <span class="position">Directrice Clientèle</span>
                    <p>Dédiée à votre satisfaction et expérience d'achat.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials Section -->
<div class="testimonial-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title">Témoignages</h2>
                <p>Ce que nos clients disent de nous</p>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-lg-8">
                <div class="testimonial-block text-center">
                    <blockquote class="mb-4">
                        <p>"Depuis que j'ai découvert E-Market, mes achats en ligne sont devenus un vrai plaisir. La qualité des produits et le service client sont exceptionnels."</p>
                    </blockquote>
                    <div class="author-info">
                        <div class="author-pic">
                            <img src="{{ asset('images/person-1.png') }}" alt="Maria Jones" class="img-fluid">
                        </div>
                        <h3 class="font-weight-bold">Maria Jones</h3>
                        <span class="position">Cliente depuis 2022</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/tiny-slider.js') }}"></script>
<script>
    // Activation du slider de témoignages
    var slider = tns({
        container: '.testimonial-slider',
        items: 1,
        slideBy: 'page',
        autoplay: true,
        autoplayButtonOutput: false,
        nav: false,
        controlsContainer: '#testimonial-nav',
        responsive: {
            768: {
                items: 2
            }
        }
    });
</script>
@endsection