@extends ('backend.layouts.app')

@section('content')
<div class="container">
    <div class="card col-8" style="padding-left: 16px padding-top:25px; padding-bottom:50px">
        <div class="card-body  " style="padding-left: 16px">
    <div class="d-flex  justify-content-between">
    <h3>Edit Billing Address</h3>
    <div>
        <a href="{{ route('billing-detail') }}" class="btn text-primary" style="    background: var(--transparent-primary-8, rgba(0, 125, 254, 0.08));"> Back</a>
        </div>
    </div>

    <!-- Edit Billing Address Form -->
    <form method="POST" class="col-10" action="{{ route('billing-addresses.update', $billingAddress->id) }}">
        @csrf
        @method('PUT') {{-- This is used to simulate a PUT request --}}
        
        <!-- User ID Field (Hidden) -->
        <input type="hidden" name="user_id" value="{{ $billingAddress->user_id }}">
    
        
        <!-- City Field -->
        <div class="form-group">
            <label for="city">City</label>
            <input type="text " name="city" id="city" class="form-control " value="{{ $billingAddress->city }}">
        </div>
        
        <!-- State Field -->
        <div class="form-group">
            <label for="state">Street</label>
            <input type="text " name="street" id="street" class="form-control " value="{{ $billingAddress->street}}">
        </div>
        
        <!-- Postal Code Field -->
        <div class="form-group">
            <label for="postal_code">Postal Code</label>
            <input type="text " name="postal_code" id="postal_code" class="form-control " value="{{ $billingAddress->postal_code }}">
        </div>
        @php

    $countries = [
        'Afghanistan',
        'Åland Islands',
        'Albania',
        'Algeria',
        'American Samoa',
        'Andorra',
        'Angola',
        'Anguilla',
        'Antarctica',
        'Antigua and Barbuda',
        'Argentina',
        'Armenia',
        'Aruba',
        'Australia',
        'Austria',
        'Azerbaijan',
        'Bahamas',
        'Bahrain',
        'Bangladesh',
        'Barbados',
        'Belarus',
        'Belgium',
        'Belize',
        'Benin',
        'Bermuda',
        'Bhutan',
        'Bolivia',
        'Bosnia and Herzegovina',
        'Botswana',
        'Bouvet Island',
        'Brazil',
        'British Indian Ocean Territory',
        'Brunei Darussalam',
        'Bulgaria',
        'Burkina Faso',
        'Burundi',
        'Cambodia',
        'Cameroon',
        'Canada',
        'Cape Verde',
        'Cayman Islands',
        'Central African Republic',
        'Chad',
        'Chile',
        'China',
        'Christmas Island',
        'Cocos (Keeling) Islands',
        'Colombia',
        'Comoros',
        'Congo',
        'Congo, The Democratic Republic of The',
        'Cook Islands',
        'Costa Rica',
        'Cote D\'ivoire',
        'Croatia',
        'Cuba',
        'Cyprus',
        'Czech Republic',
        'Denmark',
        'Djibouti',
        'Dominica',
        'Dominican Republic',
        'Ecuador',
        'Egypt',
        'El Salvador',
        'Equatorial Guinea',
        'Eritrea',
        'Estonia',
        'Ethiopia',
        'Falkland Islands (Malvinas)',
        'Faroe Islands',
        'Fiji',
        'Finland',
        'France',
        'French Guiana',
        'French Polynesia',
        'French Southern Territories',
        'Gabon',
        'Gambia',
        'Georgia',
        'Germany',
        'Ghana',
        'Gibraltar',
        'Greece',
        'Greenland',
        'Grenada',
        'Guadeloupe',
        'Guam',
        'Guatemala',
        'Guernsey',
        'Guinea',
        'Guinea-bissau',
        'Guyana',
        'Haiti',
        'Heard Island and Mcdonald Islands',
        'Holy See (Vatican City State)',
        'Honduras',
        'Hong Kong',
        'Hungary',
        'Iceland',
        'India',
        'Indonesia',
        'Iran, Islamic Republic of',
        'Iraq',
        'Ireland',
        'Isle of Man',
        'Israel',
        'Italy',
        'Jamaica',
        'Japan',
        'Jersey',
        'Jordan',
        'Kazakhstan',
        'Kenya',
        'Kiribati',
        'Korea, Democratic People\'s Republic of',
        'Korea, Republic of',
        'Kuwait',
        'Kyrgyzstan',
        'Lao People\'s Democratic Republic',
        'Latvia',
        'Lebanon',
        'Lesotho',
        'Liberia',
        'Libyan Arab Jamahiriya',
        'Liechtenstein',
        'Lithuania',
        'Luxembourg',
        'Macao',
        'Macedonia, The Former Yugoslav Republic of',
        'Madagascar',
        'Malawi',
        'Malaysia',
        'Maldives',
        'Mali',
        'Malta',
        'Marshall Islands',
        'Martinique',
        'Mauritania',
        'Mauritius',
        'Mayotte',
        'Mexico',
        'Micronesia, Federated States of',
        'Moldova, Republic of',
        'Monaco',
        'Mongolia',
        'Montenegro',
        'Montserrat',
        'Morocco',
        'Mozambique',
        'Myanmar',
        'Namibia',
        'Nauru',
        'Nepal',
        'Netherlands',
        'Netherlands Antilles',
        'New Caledonia',
        'New Zealand',
        'Nicaragua',
        'Niger',
        'Nigeria',
        'Niue',
        'Norfolk Island',
        'Northern Mariana Islands',
        'Norway',
        'Oman',
        'Pakistan',
        'Palau',
        'Palestinian Territory, Occupied',
        'Panama',
        'Papua New Guinea',
        'Paraguay',
        'Peru',
        'Philippines',
        'Pitcairn',
        'Poland',
        'Portugal',
        'Puerto Rico',
        'Qatar',
        'Reunion',
        'Romania',
        'Russian Federation',
        'Rwanda',
        'Saint Helena',
        'Saint Kitts and Nevis',
        'Saint Lucia',
        'Saint Pierre and Miquelon',
        'Saint Vincent and The Grenadines',
        'Samoa',
        'San Marino',
        'Sao Tome and Principe',
        'Saudi Arabia',
        'Senegal',
        'Serbia',
        'Seychelles',
        'Sierra Leone',
        'Singapore',
        'Slovakia',
        'Slovenia',
        'Solomon Islands',
        'Somalia',
        'South Africa',
        'South Georgia and The South Sandwich Islands',
        'Spain',
        'Sri Lanka',
        'Sudan',
        'Suriname',
        'Svalbard and Jan Mayen',
        'Swaziland',
        'Sweden',
        'Switzerland',
        'Syrian Arab Republic',
        'Taiwan',
        'Tajikistan',
        'Tanzania, United Republic of',
        'Thailand',
        'Timor-leste',
        'Togo',
        'Tokelau',
        'Tonga',
        'Trinidad and Tobago',
        'Tunisia',
        'Turkey',
        'Turkmenistan',
        'Turks and Caicos Islands',
        'Tuvalu',
        'Uganda',
        'Ukraine',
        'United Arab Emirates',
        'United Kingdom',
        'United States',
        'United States Minor Outlying Islands',
        'Uruguay',
        'Uzbekistan',
        'Vanuatu',
        'Venezuela',
        'Viet Nam',
        'Virgin Islands, British',
        'Virgin Islands, U.S.',
        'Wallis and Futuna',
        'Western Sahara',
        'Yemen',
        'Zambia',
        'Zimbabwe',
    ];


@endphp
        <!-- Country Field -->
     
<div class="form-group">
    <label for="country">Country</label>
    <select name="country" id="country" class="form-control ">
        @foreach ($countries as $country)
            <option value="{{ $country }}" {{ $billingAddress->country == $country ? 'selected' : '' }}>
                {{ $country }}
            </option>
        @endforeach
    </select>
</div>


        <!-- Mobile Number Field -->
        <div class="form-group">
            <label for="mobile_number">Mobile Number</label>
            <input type="text" name="mobile" id="mobile" class="form-control " value="{{ $billingAddress->mobile}}">
        </div>

        <!-- Submit Button -->
        <button type="submit"  style="background: var(--transparent-primary-16, rgba(0, 171, 85, 0.16));
        color:#007B55" class="btn  mt-4 mb-5">Update</button>
    </form>
        </div>
    </div>
</div>
@endsection