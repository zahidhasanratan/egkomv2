@extends('auth.layout.super_admin_layout')

@section('mainbody')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Banking Information</h3>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        @if (session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <form method="POST" action="{{ route('super.bankings.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="vendor_id" class="form-control" id="account_number" placeholder="Account Number" value="{{ old('vendor_id', $banking->vendor_id ?? '') }}" >
                                    <div class="row gy-4">
                                        <div class="col-lg-4">
                                            <div class="bank-all-info">
                                                <h3 class="pay-method-title">Please Select Payment Method</h3>
                                                <div class="radio-buttons form-group" style="margin-top: 20px;">
                                                    <label class="form-label">
                                                        <input type="radio" name="payment_method" value="Bank" id="yesOption" {{ old('payment_method', $banking->payment_method ?? '') === 'Bank' ? 'checked' : '' }}> Bank
                                                    </label>
                                                    <label class="form-label">
                                                        <input type="radio" name="payment_method" value="Mobile Banking" id="noOption" {{ old('payment_method', $banking->payment_method ?? '') === 'Mobile Banking' ? 'checked' : '' }}> Mobile Banking
                                                    </label>
                                                    @error('payment_method')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="yesFields" class="input-section {{ old('payment_method', $banking->payment_method ?? '') === 'Bank' ? '' : 'hidden' }}">
                                        <div class="row gy-4">
                                            <div class="col-md-6 col-lg-4 col-xxl-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="account_number">Account Number</label>
                                                    <input type="text" name="account_number" class="form-control" id="account_number" placeholder="Account Number" value="{{ old('account_number', $banking->account_number ?? '') }}" {{ old('payment_method', $banking->payment_method ?? '') === 'Bank' ? 'required' : '' }}>
                                                    @error('account_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4 col-xxl-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="bank_name">Bank Name</label>
                                                    <select name="bank_name" class="form-select js-select2" id="propertyOwnershipss" data-placeholder="Select Bank Name">
                                                        <option value="">Select Bank Name</option>
                                                        <option value="ab-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'ab-bank-plc' ? 'selected' : '' }}>AB Bank PLC</option>
                                                        <option value="agrani-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'agrani-bank-plc' ? 'selected' : '' }}>Agrani Bank PLC</option>
                                                        <option value="al-arafah-islami-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'al-arafah-islami-bank-plc' ? 'selected' : '' }}>Al-Arafah Islami Bank PLC</option>
                                                        <option value="bangladesh-commerce-bank-limited" {{ old('bank_name', $banking->bank_name ?? '') === 'bangladesh-commerce-bank-limited' ? 'selected' : '' }}>Bangladesh Commerce Bank Limited</option>
                                                        <option value="bangladesh-development-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'bangladesh-development-bank-plc' ? 'selected' : '' }}>Bangladesh Development Bank PLC</option>
                                                        <option value="bangladesh-krishi-bank" {{ old('bank_name', $banking->bank_name ?? '') === 'bangladesh-krishi-bank' ? 'selected' : '' }}>Bangladesh Krishi Bank</option>
                                                        <option value="bank-al-falah-limited" {{ old('bank_name', $banking->bank_name ?? '') === 'bank-al-falah-limited' ? 'selected' : '' }}>Bank Al-Falah Limited</option>
                                                        <option value="bank-asia-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'bank-asia-plc' ? 'selected' : '' }}>Bank Asia PLC</option>
                                                        <option value="basic-bank-limited" {{ old('bank_name', $banking->bank_name ?? '') === 'basic-bank-limited' ? 'selected' : '' }}>BASIC Bank Limited</option>
                                                        <option value="bengal-commercial-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'bengal-commercial-bank-plc' ? 'selected' : '' }}>Bengal Commercial Bank PLC</option>
                                                        <option value="brac-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'brac-bank-plc' ? 'selected' : '' }}>BRAC Bank PLC</option>
                                                        <option value="citibank-na" {{ old('bank_name', $banking->bank_name ?? '') === 'citibank-na' ? 'selected' : '' }}>Citibank N.A</option>
                                                        <option value="citizens-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'citizens-bank-plc' ? 'selected' : '' }}>Citizens Bank PLC</option>
                                                        <option value="city-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'city-bank-plc' ? 'selected' : '' }}>City Bank PLC</option>
                                                        <option value="commercial-bank-of-ceylon-limited" {{ old('bank_name', $banking->bank_name ?? '') === 'commercial-bank-of-ceylon-limited' ? 'selected' : '' }}>Commercial Bank of Ceylon Limited</option>
                                                        <option value="community-bank-bangladesh-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'community-bank-bangladesh-plc' ? 'selected' : '' }}>Community Bank Bangladesh PLC</option>
                                                        <option value="dhaka-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'dhaka-bank-plc' ? 'selected' : '' }}>Dhaka Bank PLC</option>
                                                        <option value="dutch-bangla-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'dutch-bangla-bank-plc' ? 'selected' : '' }}>Dutch-Bangla Bank PLC</option>
                                                        <option value="eastern-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'eastern-bank-plc' ? 'selected' : '' }}>Eastern Bank PLC</option>
                                                        <option value="export-import-bank-of-bangladesh-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'export-import-bank-of-bangladesh-plc' ? 'selected' : '' }}>Export Import Bank of Bangladesh PLC</option>
                                                        <option value="first-security-islami-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'first-security-islami-bank-plc' ? 'selected' : '' }}>First Security Islami Bank PLC</option>
                                                        <option value="global-islami-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'global-islami-bank-plc' ? 'selected' : '' }}>Global Islami Bank PLC</option>
                                                        <option value="habib-bank-ltd" {{ old('bank_name', $banking->bank_name ?? '') === 'habib-bank-ltd' ? 'selected' : '' }}>Habib Bank Ltd.</option>
                                                        <option value="icb-islamic-bank-ltd" {{ old('bank_name', $banking->bank_name ?? '') === 'icb-islamic-bank-ltd' ? 'selected' : '' }}>ICB Islamic Bank Ltd.</option>
                                                        <option value="ific-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'ific-bank-plc' ? 'selected' : '' }}>IFIC Bank PLC</option>
                                                        <option value="islami-bank-bangladesh-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'islami-bank-bangladesh-plc' ? 'selected' : '' }}>Islami Bank Bangladesh PLC</option>
                                                        <option value="jamuna-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'jamuna-bank-plc' ? 'selected' : '' }}>Jamuna Bank PLC</option>
                                                        <option value="janata-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'janata-bank-plc' ? 'selected' : '' }}>Janata Bank PLC</option>
                                                        <option value="meghna-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'meghna-bank-plc' ? 'selected' : '' }}>Meghna Bank PLC</option>
                                                        <option value="mercantile-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'mercantile-bank-plc' ? 'selected' : '' }}>Mercantile Bank PLC</option>
                                                        <option value="midland-bank-limited" {{ old('bank_name', $banking->bank_name ?? '') === 'midland-bank-limited' ? 'selected' : '' }}>Midland Bank Limited</option>
                                                        <option value="modhumoti-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'modhumoti-bank-plc' ? 'selected' : '' }}>Modhumoti Bank PLC</option>
                                                        <option value="mutual-trust-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'mutual-trust-bank-plc' ? 'selected' : '' }}>Mutual Trust Bank PLC</option>
                                                        <option value="nagad-digital-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'nagad-digital-bank-plc' ? 'selected' : '' }}>Nagad Digital Bank PLC</option>
                                                        <option value="national-bank-limited" {{ old('bank_name', $banking->bank_name ?? '') === 'national-bank-limited' ? 'selected' : '' }}>National Bank Limited</option>
                                                        <option value="national-bank-of-pakistan" {{ old('bank_name', $banking->bank_name ?? '') === 'national-bank-of-pakistan' ? 'selected' : '' }}>National Bank of Pakistan</option>
                                                        <option value="national-credit-commerce-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'national-credit-commerce-bank-plc' ? 'selected' : '' }}>National Credit & Commerce Bank PLC</option>
                                                        <option value="nrb-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'nrb-bank-plc' ? 'selected' : '' }}>NRB Bank PLC</option>
                                                        <option value="nrbc-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'nrbc-bank-plc' ? 'selected' : '' }}>NRBC Bank PLC</option>
                                                        <option value="one-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'one-bank-plc' ? 'selected' : '' }}>One Bank PLC</option>
                                                        <option value="padma-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'padma-bank-plc' ? 'selected' : '' }}>Padma Bank PLC</option>
                                                        <option value="prime-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'prime-bank-plc' ? 'selected' : '' }}>Prime Bank PLC</option>
                                                        <option value="probashi-kollyan-bank" {{ old('bank_name', $banking->bank_name ?? '') === 'probashi-kollyan-bank' ? 'selected' : '' }}>Probashi Kollyan Bank</option>
                                                        <option value="pubali-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'pubali-bank-plc' ? 'selected' : '' }}>Pubali Bank PLC</option>
                                                        <option value="rajshahi-krishi-unnayan-bank" {{ old('bank_name', $banking->bank_name ?? '') === 'rajshahi-krishi-unnayan-bank' ? 'selected' : '' }}>Rajshahi Krishi Unnayan Bank</option>
                                                        <option value="rupali-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'rupali-bank-plc' ? 'selected' : '' }}>Rupali Bank PLC</option>
                                                        <option value="sbac-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'sbac-bank-plc' ? 'selected' : '' }}>SBAC Bank PLC</option>
                                                        <option value="shahjalal-islami-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'shahjalal-islami-bank-plc' ? 'selected' : '' }}>Shahjalal Islami Bank PLC</option>
                                                        <option value="shimanto-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'shimanto-bank-plc' ? 'selected' : '' }}>Shimanto Bank PLC</option>
                                                        <option value="social-islami-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'social-islami-bank-plc' ? 'selected' : '' }}>Social Islami Bank PLC</option>
                                                        <option value="sonali-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'sonali-bank-plc' ? 'selected' : '' }}>Sonali Bank PLC</option>
                                                        <option value="southeast-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'southeast-bank-plc' ? 'selected' : '' }}>Southeast Bank PLC</option>
                                                        <option value="standard-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'standard-bank-plc' ? 'selected' : '' }}>Standard Bank PLC</option>
                                                        <option value="standard-chartered-bank" {{ old('bank_name', $banking->bank_name ?? '') === 'standard-chartered-bank' ? 'selected' : '' }}>Standard Chartered Bank</option>
                                                        <option value="state-bank-of-india" {{ old('bank_name', $banking->bank_name ?? '') === 'state-bank-of-india' ? 'selected' : '' }}>State Bank of India</option>
                                                        <option value="hsbc-bangladesh" {{ old('bank_name', $banking->bank_name ?? '') === 'hsbc-bangladesh' ? 'selected' : '' }}>The Hong Kong and Shanghai Banking Corporation. Ltd.</option>
                                                        <option value="the-premier-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'the-premier-bank-plc' ? 'selected' : '' }}>The Premier Bank PLC</option>
                                                        <option value="trust-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'trust-bank-plc' ? 'selected' : '' }}>Trust Bank PLC</option>
                                                        <option value="union-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'union-bank-plc' ? 'selected' : '' }}>Union Bank PLC</option>
                                                        <option value="united-commercial-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'united-commercial-bank-plc' ? 'selected' : '' }}>United Commercial Bank PLC</option>
                                                        <option value="uttara-bank-plc" {{ old('bank_name', $banking->bank_name ?? '') === 'uttara-bank-plc' ? 'selected' : '' }}>Uttara Bank PLC</option>
                                                        <option value="woori-bank" {{ old('bank_name', $banking->bank_name ?? '') === 'woori-bank' ? 'selected' : '' }}>Woori Bank</option>
                                                    </select>
                                                    @error('bank_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4 col-xxl-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="routing_number">Routing Number</label>
                                                    <input type="number" name="routing_number" class="form-control" id="routing_number" placeholder="Routing Number" value="{{ old('routing_number', $banking->routing_number ?? '') }}">
                                                    @error('routing_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4 col-xxl-3">
                                                <div class="form-group">
                                                    <label class="form-label">Account Type</label>
                                                    <select name="account_type" class="form-select js-select2" data-placeholder="Select Account Type">
                                                        <option value="">Select Account Type</option>
                                                        <option value="Current" {{ old('account_type', $banking->account_type ?? '') === 'Current' ? 'selected' : '' }}>Current</option>
                                                        <option value="Savings" {{ old('account_type', $banking->account_type ?? '') === 'Savings' ? 'selected' : '' }}>Savings</option>
                                                        <option value="etc" {{ old('account_type', $banking->account_type ?? '') === 'etc' ? 'selected' : '' }}>etc</option>
                                                    </select>
                                                    @error('account_type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-4 col-xxl-3">
                                                <div class="form-group mt-15">
                                                    <label class="form-label">Upload Picture of the Bank Cheque</label>
                                                    <div class="single-upload-container">
                                                        <input type="file" name="bank_cheque_image" id="single-file-input" accept="image/*">
                                                        <label for="single-file-input" class="upload-label">Select Bank Cheque</label>
                                                        <div class="single-thumbnail-preview" id="single-thumbnail-preview">
                                                            @if($banking && $banking->bank_cheque_image)
                                                                <img src="{{ asset('storage/' . $banking->bank_cheque_image) }}" alt="Bank Cheque" style="max-width: 100%;">
                                                            @else
                                                                <span class="single-placeholder">No image selected</span>
                                                            @endif
                                                        </div>
                                                        @error('bank_cheque_image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gy-4">
                                            <div class="col-sm-2 col-md-2 mt-15">
                                                <div class="form-group">
                                                    <button type="submit" name="action" value="submit" class="btn btn-primary btn-submit">Submit</button>
                                                </div>
                                            </div>
                                            <div class="col-sm-2 col-md-2 mt-15">
                                                <div class="form-group">
                                                    <button type="submit" name="action" value="draft" class="btn btn-primary">Save & Drafts</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="noFields" class="input-section {{ old('payment_method', $banking->payment_method ?? '') === 'Mobile Banking' ? '' : 'hidden' }}">
                                        <div class="row gy-4">
                                            <div class="col-md-6 col-lg-4 col-xxl-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="bakshe_number">Bakshe Number</label>
                                                    <input type="number" name="bakshe_number" class="form-control" id="bakshe_number" placeholder="Bakshe Number" value="{{ old('bakshe_number', $banking->bakshe_number ?? '') }}">
                                                    @error('bakshe_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4 col-xxl-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="nagad_number">Nagad Number</label>
                                                    <input type="number" name="nagad_number" class="form-control" id="nagad_number" placeholder="Nagad Number" value="{{ old('nagad_number', $banking->nagad_number ?? '') }}">
                                                    @error('nagad_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4 col-xxl-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="dutch_bangla_number">Dutch Bangla Mobile Banking Number</label>
                                                    <input type="number" name="dutch_bangla_number" class="form-control" id="dutch_bangla_number" placeholder="Dutch Bangla Mobile Banking Number" value="{{ old('dutch_bangla_number', $banking->dutch_bangla_number ?? '') }}">
                                                    @error('dutch_bangla_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gy-4" style="margin-top: 40px">
                                            <div class="col-sm-2 col-md-2 mt-15">
                                                <div class="form-group">
                                                    <button type="submit" name="action" value="submit" class="btn btn-primary btn-submit">Submit</button>
                                                </div>
                                            </div>
                                            <div class="col-sm-2 col-md-2 mt-15">
                                                <div class="form-group">
                                                    <button type="submit" name="action" value="draft" class="btn btn-primary">Save & Drafts</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const yesOption = document.getElementById("yesOption");
            const noOption = document.getElementById("noOption");
            const yesFields = document.getElementById("yesFields");
            const noFields = document.getElementById("noFields");

            yesOption.addEventListener("change", function () {
                if (this.checked) {
                    yesFields.classList.remove("hidden");
                    noFields.classList.add("hidden");
                }
            });

            noOption.addEventListener("change", function () {
                if (this.checked) {
                    noFields.classList.remove("hidden");
                    yesFields.classList.add("hidden");
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const singleFileInput = document.getElementById('single-file-input');
            const singleThumbnailPreview = document.getElementById('single-thumbnail-preview');

            singleFileInput.addEventListener('change', handleSingleFileUpload);

            function handleSingleFileUpload(event) {
                const file = event.target.files[0];
                singleThumbnailPreview.innerHTML = '';

                if (!file || !file.type.startsWith('image/')) {
                    singleThumbnailPreview.innerHTML = '<span class="single-placeholder">Invalid image</span>';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    const removeBtn = document.createElement('button');
                    removeBtn.innerHTML = '×';
                    removeBtn.classList.add('single-remove-btn');
                    removeBtn.addEventListener('click', () => {
                        singleThumbnailPreview.innerHTML = '<span class="single-placeholder">No image selected</span>';
                        singleFileInput.value = '';
                    });
                    singleThumbnailPreview.appendChild(img);
                    singleThumbnailPreview.appendChild(removeBtn);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
