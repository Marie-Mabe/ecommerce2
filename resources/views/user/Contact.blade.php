@extends('user.navigation.layout')

@section('tittle', 'Contactez nous')

@section('content')

<style>
    .hero-contact {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        padding: 100px 0;
    }
    
    .contact-info-card {
        transition: all 0.3s ease;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        height: 100%;
    }
    
    .contact-info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .contact-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 24px;
        color: #fff;
    }
    
    .contact-form {
        background: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .form-control:focus {
        border-color: #2f89fc;
        box-shadow: 0 0 0 0.25rem rgba(47, 137, 252, 0.25);
    }
    
    .btn-contact {
        background-color: #2f89fc;
        border: none;
        padding: 10px 30px;
        transition: all 0.3s;
    }
    
    .btn-contact:hover {
        background-color: #1a73e8;
        transform: translateY(-2px);
    }
    
    .map-container {
        width: 100%;
        height: 450px;
    }
    
    .map-container iframe {
        width: 100%;
        height: 100%;
        border: none;
    }
</style>

<!-- Hero Section -->
<div class="hero-contact text-white">
    <div class="container">
        <div class="row align-items-center" style="min-height: 200px;">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 mb-3">Contactez-nous</h1>
                <p class="lead">Nous sommes à votre écoute pour toute question ou demande d'information</p>
            </div>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="untree_co-section py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row mb-5">
                    <!-- Adresse à Lomé -->
                    <div class="col-md-4">
                        <div class="contact-info-card text-center bg-white">
                            <div class="contact-icon bg-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                                </svg>
                            </div>
                            <h4>Adresse</h4>
                            <p class="mb-0">Tokoin Séminaire<br>Lomé, Togo</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-md-4">
                        <div class="contact-info-card text-center bg-white">
                            <div class="contact-icon bg-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                                </svg>
                            </div>
                            <h4>Email</h4>
                            <p class="mb-0">contact@votresociete.com</p>
                        </div>
                    </div>

                    <!-- Téléphone -->
                    <div class="col-md-4">
                        <div class="contact-info-card text-center bg-white">
                            <div class="contact-icon bg-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                </svg>
                            </div>
                            <h4>Téléphone</h4>
                            <p class="mb-0">+228 22 22 22 22</p>
                        </div>
                    </div>
                </div>

                <!-- Formulaire de contact -->
                <div class="contact-form">
                    <h2 class="text-center mb-4">Envoyez-nous un message</h2>
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="fname">Prénom</label>
                                    <input type="text" class="form-control" id="fname" placeholder="Votre prénom">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="lname">Nom</label>
                                    <input type="text" class="form-control" id="lname" placeholder="Votre nom">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="votre@email.com">
                        </div>

                        <div class="form-group mb-4">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" rows="5" placeholder="Votre message..."></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-contact text-white">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Carte Google Maps centrée sur Tokoin Séminaire, Lomé -->
<div class="container-fluid p-0">
    <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d1.221155814266789!3d6.1755603954932375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x10215832b6b7a78b%3A0x3c3a9a4a4b3b3b3b!2sTokoin%20S%C3%A9minaire%2C%20Lom%C3%A9%2C%20Togo!5e0!3m2!1sfr!2sfr!4v1624455354787!5m2!1sfr!2sfr" 
                allowfullscreen="" 
                loading="lazy"></iframe>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/tiny-slider.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script>
    // Animation pour les cartes de contact
    document.addEventListener('DOMContentLoaded', function() {
        const contactCards = document.querySelectorAll('.contact-info-card');
        
        contactCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 200 * index);
        });

        // Validation du formulaire
        const contactForm = document.querySelector('form');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                const inputs = this.querySelectorAll('.form-control');
                let isValid = true;
                
                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    alert('Veuillez remplir tous les champs obligatoires.');
                }
            });
        }
    });
</script>
@endsection