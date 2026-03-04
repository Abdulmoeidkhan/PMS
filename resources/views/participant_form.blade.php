<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Participant Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --secondary: #7c3aed;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, sans-serif;
            padding: 20px 0;
        }

        .form-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
            overflow: hidden
        }

        .form-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            padding: 24px;
            text-align: center
        }

        .form-body {
            padding: 28px
        }

        .required::after {
            content: ' *';
            color: #ef4444
        }

        .file-upload-area {
            border: 2px dashed var(--primary);
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            background: #f8f9ff
        }

        .file-preview {
            margin-top: 10px;
            display: none;
        }

        .file-preview.show {
            display: block
        }

        .checkbox-group {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 12px
        }

        .alert-error {
            display: none
        }

        .spinner-container {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            align-items: center;
            justify-content: center;
            z-index: 9999
        }

        .spinner-container.show {
            display: flex
        }

        .spinner {
            width: 48px;
            height: 48px;
            border: 6px solid #fff;
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite
        }

        @keyframes spin {
            to {
                transform: rotate(360deg)
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark" style="background:linear-gradient(135deg,var(--primary),var(--secondary));">
        <div class="container-fluid"><a class="navbar-brand" href="/">Participant Registration</a></div>
    </nav>

    <div class="container" style="max-width:900px; margin-top:24px;">
        <div class="form-container">
            <div class="form-header">
                <h2>Participant Registration</h2>
            </div>
            <div class="form-body">
                <div class="alert alert-danger alert-error" id="errorAlert"></div>

                <form id="registrationForm" method="POST" action="{{ route('form.submit') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required" for="full_name">FULL NAME</label>
                            <input class="form-control" id="full_name" name="full_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required" for="nick_name"
                                title="Nick Name or Alias is a pseudo name of a person used instead of their real name">NICK
                                NAME/ALIAS</label>
                            <input class="form-control" id="nick_name" name="nick_name"
                                title="Nick Name or Alias is a pseudo name of a person used instead of their real name"
                                required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label required"
                            title="Passport-size formal photograph with plain white background, neutral expression, direct eye contact, even lighting, and professional attire suitable for official records.">PICTURE
                            (passport size)</label>
                        <div class="row">
                            <div class="col-md-9 mb-3"
                                style="display: flex;justify-content: center;align-items: center;">
                                <div class="file-upload-area" id="photoArea" style="flex-grow:4;">
                                    <div class="file-upload-icon"><i class="bi bi-cloud-upload"></i></div>
                                    <p
                                        title="Passport-size formal photograph with plain white background, neutral expression, direct eye contact, even lighting, and professional attire suitable for official records.">
                                        Drag & drop or click to select</p>
                                    <input type="file" id="passport_picture" name="passport_picture" accept="image/*"
                                        style="display:none;" required>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <img src="{{asset('assets/images/reference.webp')}}" alt="Passport Size" class="mb-2"
                                    style="border-radius:8px; width:150px;"
                                    title="Passport-size formal photograph with plain white background, neutral expression, direct eye contact, even lighting, and professional attire suitable for official records.">
                            </div>
                        </div>
                        <div class="file-preview" id="photoPreview">Selected: <span id="photoName"></span></div>
                    </div>

                    <div class="section-title required">SKILL CATEGORY</div>
                    <br />
                    <div class="checkbox-group mb-3" id="skillsContainer">
                        @php
                        $skills = ['Right Hand Batsman','Left Hand Batsman','Right-Arm Fast','Left-Arm Fast','All
                        Rounder','Right Arm Leg Spin','Left Arm Spinner','Off Spinner','Wicket Keeper'];
                        @endphp
                        @foreach($skills as $i => $s)
                        <div class="checkbox-item">
                            <input type="checkbox" id="skill_{{ $i }}" name="skill_categories[]" value="{{ $s }}"
                                required>
                            <label for="skill_{{ $i }}">{{ $s }}</label>
                        </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label class="form-label required" for="performance"
                            title="Enter your cricket performance details including batting style (right/left-hand), bowling type (pace/spin), and primary role in the team (batsman, bowler, all-rounder, wicketkeeper).
You may also mention previous tournament participation, notable achievements, match statistics, or any awards received.">PERFORMANCE</label>
                        <textarea class="form-control" id="performance" name="performance" rows="3"
                            title="Enter your cricket performance details including batting style (right/left-hand), bowling type (pace/spin), and primary role in the team (batsman, bowler, all-rounder, wicketkeeper).
You may also mention previous tournament participation, notable achievements, match statistics, or any awards received."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required" for="city">CITY</label>
                            <input class="form-control" id="city" name="city" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required" for="address">ADDRESS</label>
                            <input class="form-control" id="address" name="address" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required" for="mobile">MOBILE</label>
                            <input class="form-control" id="mobile" name="mobile" required placeholder="+1234567890">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required" for="email">EMAIL</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required" for="dob">DOB</label>
                            <input type="date" class="form-control" id="dob" name="dob" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required" for="nationality">NATIONALITY</label>
                            <select class="form-select" id="nationality" name="nationality" required>
                                <option value="">Select Nationality</option>
                                @php
                                $nationalities =
                                ['Afghanistan','Albania','Algeria','Andorra','Angola','Argentina','Armenia','Australia','Austria','Azerbaijan','Bahamas','Bahrain','Bangladesh','Barbados','Belarus','Belgium','Belize','Benin','Bhutan','Bolivia','Bosnia
                                and Herzegovina','Botswana','Brazil','Brunei','Bulgaria','Burkina
                                Faso','Burundi','Cambodia','Cameroon','Canada','Cape Verde','Central African
                                Republic','Chad','Chile','China','Colombia','Comoros','Congo','Costa
                                Rica','Croatia','Cuba','Cyprus','Czech
                                Republic','Denmark','Djibouti','Dominica','Dominican Republic','Ecuador','Egypt','El
                                Salvador','Equatorial
                                Guinea','Eritrea','Estonia','Ethiopia','Fiji','Finland','France','Gabon','Gambia','Georgia','Germany','Ghana','Greece','Grenada','Guatemala','Guinea','Guinea-Bissau','Guyana','Haiti','Honduras','Hungary','Iceland','Indonesia','Iran','Iraq','Ireland','Italy','Jamaica','Japan','Jordan','Kazakhstan','Kenya','Kuwait','Kyrgyzstan','Laos','Latvia','Lebanon','Lesotho','Liberia','Libya','Liechtenstein','Lithuania','Luxembourg','Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Mauritania','Mauritius','Mexico','Moldova','Monaco','Mongolia','Montenegro','Morocco','Mozambique','Myanmar','Namibia','Nepal','Netherlands','New
                                Zealand','Nicaragua','Niger','Nigeria','Norway','Oman','Pakistan','Palestine','Panama','Papua
                                New
                                Guinea','Paraguay','Peru','Philippines','Poland','Portugal','Qatar','Romania','Russia','Rwanda','Saudi
                                Arabia','Senegal','Serbia','Singapore','Slovakia','Slovenia','Somalia','South
                                Africa','South Korea','Spain','Sri
                                Lanka','Sudan','Suriname','Sweden','Switzerland','Syria','Taiwan','Tajikistan','Tanzania','Thailand','Togo','Trinidad
                                and Tobago','Tunisia','Turkey','Turkmenistan','Uganda','Ukraine','United Arab
                                Emirates','United Kingdom','United
                                States','Uruguay','Uzbekistan','Venezuela','Vietnam','Yemen','Zambia','Zimbabwe'];
                                $nationalities = array_filter($nationalities, function($n){ return $n !== 'India' && $n
                                !== 'Israel'; });
                                sort($nationalities);
                                @endphp
                                @foreach($nationalities as $nation)
                                <option value="{{ $nation }}">{{ $nation }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required" for="identity" id="identityLabel">CNIC (9-14
                                alphanumeric)</label>
                            <input class="form-control" id="identity" name="identity" pattern="^[A-Za-z0-9]{9,14}$"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required" for="kit_size">KIT SIZE</label>
                            <select class="form-select" id="kit_size" name="kit_size" required>
                                <option value="">Select</option>
                                <option value="small">small</option>
                                <option value="medium">medium</option>
                                <option value="large">large</option>
                                <option value="xl">XL</option>
                                <option value="xxl">XXL</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required" for="shirt_number">SHIRT NUMBER</label>
                            <input class="form-control" id="shirt_number" name="shirt_number" required>
                        </div>
                    </div>

                    <div id="travelBlock"
                        style="display:none; border:1px solid #dee2e6; padding:16px; border-radius:8px; margin-bottom:16px; box-shadow: 3px 3px 15px 3px #888888;">
                        <h4>Travel Information</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="airline">AIRLINE</label>
                                <input class="form-control" id="airline" name="airline">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="arrival_date">ARRIVAL DATE</label>
                                <input type="date" class="form-control" id="arrival_date" name="arrival_date">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="arrival_time">ARRIVAL TIME</label>
                                <input type="time" class="form-control" id="arrival_time" name="arrival_time">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="hotel_name">HOTEL NAME</label>
                                <input class="form-control" id="hotel_name" name="hotel_name">
                            </div>
                            {{-- <div class="col-md-6 mb-3">
                                <label class="form-label">HOTEL RESERVATION (PDF)</label>
                                <div class="file-upload-area" id="hotelArea">
                                    <div class="file-upload-icon"><i class="bi bi-file-earmark-pdf"></i></div>
                                    <p>Upload hotel reservation (PDF)</p>
                                    <input type="file" id="hotel_reservation" name="hotel_reservation"
                                        accept="application/pdf" style="display:none;">
                                </div>
                                <div class="file-preview" id="hotelPreview">Selected: <span id="hotelName"></span></div>

                                <label class="form-label mt-3">FLIGHT RESERVATION (PDF)</label>
                                <div class="file-upload-area" id="flightArea">
                                    <div class="file-upload-icon"><i class="bi bi-file-earmark-pdf"></i></div>
                                    <p>Upload flight reservation (PDF)</p>
                                    <input type="file" id="flight_reservation" name="flight_reservation"
                                        accept="application/pdf" style="display:none;">
                                </div>
                                <div class="file-preview" id="flightPreview">Selected: <span id="flightName"></span>
                                </div>
                            </div> --}}
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="checkin">CHECKIN</label>
                                <input type="date" class="form-control" id="checkin" name="checkin">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="checkout">CHECKOUT</label>
                                <input type="date" class="form-control" id="checkout" name="checkout">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-submit">Submit Registration</button>
                </form>

                <div class="alert alert-success mt-4" id="successMessage" style="display:none;">
                    <div class="success-icon"><i class="bi bi-check-circle"></i></div>
                    <h4>Registration Successful</h4>
                    <p>Thank you. A confirmation email will be sent to you.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="spinner-container" id="spinner">
        <div class="spinner"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            // Photo upload
            const photoArea = document.getElementById('photoArea');
            const photoInput = document.getElementById('passport_picture');
            const photoPreview = document.getElementById('photoPreview');
            const photoName = document.getElementById('photoName');
            photoArea.addEventListener('click', () => photoInput.click());
            photoArea.addEventListener('dragover', e=>{ e.preventDefault(); photoArea.classList.add('dragover'); });
            photoArea.addEventListener('dragleave', ()=> photoArea.classList.remove('dragover'));
            photoArea.addEventListener('drop', e=>{ e.preventDefault(); photoArea.classList.remove('dragover'); photoInput.files = e.dataTransfer.files; updatePhoto(); });
            photoInput.addEventListener('change', updatePhoto);
            function updatePhoto(){ if(photoInput.files.length){ photoPreview.classList.add('show'); photoName.textContent = photoInput.files[0].name } else { photoPreview.classList.remove('show') } }

            // Hotel reservation upload
            // const hotelArea = document.getElementById('hotelArea');
            // const hotelInput = document.getElementById('hotel_reservation');
            // const hotelPreview = document.getElementById('hotelPreview');
            // const hotelName = document.getElementById('hotelName');
            // hotelArea.addEventListener('click', () => hotelInput.click());
            // hotelArea.addEventListener('dragover', e=>{ e.preventDefault(); hotelArea.classList.add('dragover'); });
            // hotelArea.addEventListener('dragleave', ()=> hotelArea.classList.remove('dragover'));
            // hotelArea.addEventListener('drop', e=>{ e.preventDefault(); hotelArea.classList.remove('dragover'); hotelInput.files = e.dataTransfer.files; updateHotel(); });
            // hotelInput.addEventListener('change', updateHotel);
            // function updateHotel(){ if(hotelInput.files.length){ hotelPreview.classList.add('show'); hotelName.textContent = hotelInput.files[0].name } else { hotelPreview.classList.remove('show') } }

            // Flight reservation upload
            // const flightArea = document.getElementById('flightArea');
            // const flightInput = document.getElementById('flight_reservation');
            // const flightPreview = document.getElementById('flightPreview');
            // const flightName = document.getElementById('flightName');
            // flightArea.addEventListener('click', () => flightInput.click());
            // flightArea.addEventListener('dragover', e=>{ e.preventDefault(); flightArea.classList.add('dragover'); });
            // flightArea.addEventListener('dragleave', ()=> flightArea.classList.remove('dragover'));
            // flightArea.addEventListener('drop', e=>{ e.preventDefault(); flightArea.classList.remove('dragover'); flightInput.files = e.dataTransfer.files; updateFlight(); });
            // flightInput.addEventListener('change', updateFlight);
            // function updateFlight(){ if(flightInput.files.length){ flightPreview.classList.add('show'); flightName.textContent = flightInput.files[0].name } else { flightPreview.classList.remove('show') } }

            // toggle travel-related fields based on nationality
            const nationalitySelect = document.getElementById('nationality');
            const travelBlock = document.getElementById('travelBlock');
            const identityLabel = document.getElementById('identityLabel');
            function toggleRelevantFields(){
                const val = nationalitySelect.value || '';
                const show = val !== '' && val !== 'Pakistan';
                travelBlock.style.display = show ? '' : 'none';
                identityLabel.textContent = show ? 'Passport Number' : 'CNIC';
                // enable/disable contained controls to avoid browser validation on hidden fields
                const controls = travelBlock.querySelectorAll('input, select, textarea');
                controls.forEach(c => { c.disabled = !show; });
            }
            nationalitySelect.addEventListener('change', toggleRelevantFields);
            toggleRelevantFields();

            // Form submit
            document.getElementById('registrationForm').addEventListener('submit', function(e){
                e.preventDefault();
                const selectedSkills = document.querySelectorAll('input[name="skill_categories[]"]:checked');
                if(selectedSkills.length === 0){ showError('Please select at least one skill category'); return; }
                const spinner = document.getElementById('spinner'); spinner.classList.add('show');
                const fd = new FormData(this);
                // Ensure skill_categories[] values are present
                fetch('{{ route('form.submit') }}', { method:'POST', body:fd, headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 'Accept':'application/json' } })
                    .then(r=>r.json().catch(()=>({ success:false, message:'Invalid server response' }))).then(data=>{
                        spinner.classList.remove('show');
                        if(data.success){ document.getElementById('registrationForm').style.display='none'; document.getElementById('successMessage').style.display='block'; setTimeout(()=>location.reload(),3000); } else { showError(data.message || 'Submission failed'); }
                    }).catch(err=>{ spinner.classList.remove('show'); showError(err.message || 'Network error'); });
            });

            function showError(msg){ const e=document.getElementById('errorAlert'); e.textContent=msg; e.style.display='block'; window.scrollTo({top:0,behavior:'smooth'}); }
        });
    </script>
</body>

</html>