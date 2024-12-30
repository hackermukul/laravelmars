<!-- Footer Section -->
<footer class="footer text-center">
    <div class="container">
        <p><strong>College Name:</strong> {{ $companyProfile->name }}</p>

        <!-- Conditionally show the address if it is not empty -->
        @if($companyProfile->address1)
            <p><strong>Address:</strong> {{ $companyProfile->address1 }}</p>
        @endif

        <!-- Conditionally show the email if it is not empty -->
        @if($companyProfile->email)
            <p><strong>Email:</strong> <a href="mailto:{{ $companyProfile->email }}">{{ $companyProfile->email }}</a></p>
        @endif

        <!-- Conditionally show the phone if it is not empty -->
        @if($companyProfile->mobile_no)
            <p><strong>Phone:</strong> <a href="tel:{{ $companyProfile->mobile_no }}">{{ $companyProfile->mobile_no }}</a></p>
        @endif

        <!-- Always show the Privacy Policy and Terms of Service links -->
        
    </div>
</footer>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
