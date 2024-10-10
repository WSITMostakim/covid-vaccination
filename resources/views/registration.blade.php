@extends('layout')

@section('title', 'Vaccination Registration')

@section('content')
    <div class="container">
        <h2>Vaccination Registration</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="regForm" action="{{ route('vaccine.register.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                <div class="invalid-feedback" id="nameError"></div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                    required>
                <div class="invalid-feedback" id="emailError"></div>
            </div>

            <div class="mb-3">
                <label for="nid" class="form-label">NID Number</label>
                <input type="text" class="form-control" id="nid" name="nid" value="{{ old('nid') }}"
                    required>
                <div class="invalid-feedback" id="nidError"></div>
            </div>

            <div class="mb-3">
                <label for="center" class="form-label">Vaccine Center</label>
                <select class="form-select" id="center" name="center" required>
                    <option value="">Select a Vaccine Center</option>
                    @foreach ($centers as $center)
                        <option {{ old('center') == $center->id ? 'selected' : '' }} value="{{ $center->id }}">
                            {{ $center->name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback" id="vaccineCenterError"></div>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('regForm').addEventListener('submit', function(event) {
                let valid = true;
                document.getElementById('nameError').textContent = '';
                document.getElementById('nidError').textContent = '';
                document.getElementById('vaccineCenterError').textContent = '';

                const nameInput = document.getElementById('name');
                if (nameInput.value.trim() === '') {
                    valid = false;
                    nameInput.classList.add('is-invalid');
                    document.getElementById('nameError').textContent = 'Full Name is required.';
                } else {
                    nameInput.classList.remove('is-invalid');
                }

                const emailInput = document.getElementById('email');
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailInput.value.trim())) {
                    valid = false;
                    emailInput.classList.add('is-invalid');
                    document.getElementById('emailError').textContent =
                        'Please enter a valid email address.';
                } else {
                    emailInput.classList.remove('is-invalid');
                }

                const nidInput = document.getElementById('nid');
                if (nidInput.value.trim().length <= 5) {
                    valid = false;
                    nidInput.classList.add('is-invalid');
                    document.getElementById('nidError').textContent =
                        'NID Number must be at least 6 digits.';
                } else {
                    nidInput.classList.remove('is-invalid');
                }

                const vaccineCenterSelect = document.getElementById('center');
                if (vaccineCenterSelect.value === '') {
                    valid = false;
                    vaccineCenterSelect.classList.add('is-invalid');
                    document.getElementById('vaccineCenterError').textContent =
                        'Please select a Vaccine Center.';
                } else {
                    vaccineCenterSelect.classList.remove('is-invalid');
                }

                if (!valid) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection
