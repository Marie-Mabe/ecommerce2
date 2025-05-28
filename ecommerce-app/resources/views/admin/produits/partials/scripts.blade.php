<!-- scripts.blade.php -->
<!-- Bibliothèques JS -->
<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({
        title: 'Succès!',
        text: "{{ session('success') }}",
        icon: 'success',
        timer: 3000,
        timerProgressBar: true,
        showConfirmButton: false
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        title: 'Erreur!',
        text: "{{ session('error') }}",
        icon: 'error',
        timer: 3000,
        timerProgressBar: true,
        showConfirmButton: false
    });
</script>
@endif

@stack('scripts')  <!-- Pour les scripts spécifiques aux pages -->