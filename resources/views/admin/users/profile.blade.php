@extends('admin.layouts.master')

@section('content')

    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-4 col-12">
                <div class="card ">
                    <div class="card-content">
                        <div class="card-body ">
                            <form class="form form-vertical">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12 text-center mb-5 ">
                                            <div class="avatar avatar-xl me-3 mb-3  ">
                                                @if ($user->avatar == null)
                                                <span
                                                    class="avatar-title rounded-circle border border-dark">{{\Illuminate\Support\Str::limit($user->name, 1 ,'')}}</span>
                                                @else
                                                    <img src="{{asset('assets/images/users/'.$user->avatar)}}" alt="..."
                                                        class="avatar-img rounded-circle">
                                                @endif
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="col-12 ">

                                            <h3 class=""> User info: </h3>
                                            <div class="row mb-3">
                                                <div div class="col-md-6 ">
                                                    <div class=" text-nowrap mb-1">Name: </div>
                                                </div>
                                                <div div class="col-md-6 ">
                                                    <div class=" text-nowrap mb-1" > {{ $user->name }} </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div div class="col-md-6 ">
                                                    <div class=" text-nowrap mb-1">Username: </div>
                                                </div>
                                                <div div class="col-md-6 ">
                                                    <div class=" text-nowrap mb-1" > {{ $user->username }} </div>
                                                </div>
                                            </div> <div class="row mb-3">
                                                <div div class="col-md-6 ">
                                                    <div class=" text-nowrap mb-1">Email: </div>
                                                </div>
                                                <div div class="col-md-6 ">
                                                    <div class="  mb-1" > {{ $user->email }} </div>
                                                </div>
                                            </div> <div class="row mb-3">
                                                <div div class="col-md-6 ">
                                                    <div class="card-title text-nowrap mb-1">Mobile: </div>
                                                </div>
                                                <div div class="col-md-6 ">
                                                    <div class=" text-nowrap mb-1" > {{ $user->phone }} </div>
                                                </div>
                                            </div> <div class="row mb-3">
                                                <div div class="col-md-6 ">
                                                    <div class=" text-nowrap mb-1">Refferal By: </div>
                                                </div>
                                                <div div class="col-md-6 ">
                                                    @if ($ref)
                                                    <a href="{{route('admin.user.edit', $ref->id)}}"> {{ $ref->name }} </a>
                                                    @else
                                                    sN/A
                                                    @endif
                                                </div>
                                            </div> <div class="row mb-3">
                                                <div div class="col-md-6 ">
                                                    <div class=" text-nowrap mb-1">Status: </div>
                                                </div>
                                                <div div class="col-md-6 ">
                                                    <div class=" text-nowrap mb-1" >
                                                          @if ($user->status == 1)
                                                        <span >Active</span>
                                                        @elseif ($user->status == 0)
                                                        <span >Blocked</span>
                                                        @else
                                                        <span >Pending</span>
                                                        @endif </div>
                                                </div>
                                        </div>


                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-12">
                <div class="card ">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">

                                <div class=" col-md-6 mb-3">
                                    <div class="custom-card rounded">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4  ">
                                                    <div class="stats-icon green  mb-2">
                                                        <i class="fas fa-wallet"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <h6 class="">Deposit Wallet Balance</h6>
                                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($user->balance)}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6 mb-3">
                                    <div class="custom-card2 rounded">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4  ">
                                                    <div class="stats-icon blue mb-2">
                                                        <i class="fas fa-wallet"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <h6 >Interest Wallet Balance</h6>
                                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($user->interest_balance)}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <div class="custom-card3 rounded">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4  ">
                                                    <div class="stats-icon blue mb-2">
                                                        <i class="fas fa-coins"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <h6 class="">Total Invest</h6>
                                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($total_invest)}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <div class="custom-card4 rounded">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4  ">
                                                    <div class="stats-icon blue mb-2">
                                                        <i class="fas fa-coins"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <h6 class="">Total Interest Return</h6>
                                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($total_interest_return)}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <div class="custom-card2 rounded">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4  ">
                                                    <div class="stats-icon blue mb-2">
                                                        <i class="fas fa-coins"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <h6 class="">Total Referral Commission</h6>
                                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($ref_com)}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <div class="custom-card rounded">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4  ">
                                                    <div class="stats-icon green mb-2">
                                                        <i class="fas fa-coins"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <h6 >Total Deposit</h6>
                                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($total_deposit)}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <div class="custom-card4 rounded">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4 ">
                                                    <div class="stats-icon green mb-2">
                                                        <i class="fas fa-coins"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <h6 >Total Withdraw</h6>
                                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($total_Withdrawal)}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <div class="custom-card4 rounded">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4  ">
                                                    <div class="stats-icon blue mb-2">
                                                        <i class="fas fa-coins"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <h6 >Total Transection</h6>
                                                    <h6 class="font-extrabold mb-0">{{ $total_trx }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <button type="button"  class="btn btn-success btn-block me-1 mb-3" data-bs-toggle="modal"
                                        data-bs-target="#addModal" >Add Balance</button>
                                    {{-- <a href=""   class="btn btn-success btn-block me-1 mb-3">Add Balance</a> --}}

                                </div>
                                <div class="col-md-6">
                                    <button type="button"  class="btn btn-danger btn-block me-1 mb-3" data-bs-toggle="modal"
                                        data-bs-target="#subModal" >Subtract Balance</button>
                                    {{-- <a href=""   class="btn btn-success btn-block me-1 mb-3">Add Balance</a> --}}

                                </div>

                                <div class="col-sm-4">
                                    <a href=""   class="btn btn-primary btn-block me-1 mb-3">View Transections</a>

                                </div>
                                <div class="col-sm-4 ">
                                    <a href=""   class="btn btn-primary btn-block me-1 mb-3">Deposit history</a>

                                </div>

                                <div class="col-sm-4 ">
                                    <a href=""   class="btn btn-primary btn-block me-1 mb-3">Investment history</a>

                                </div>

                                <div class="col-sm-4 ">
                                    <a href=""   class="btn btn-primary btn-block me-1 mb-3">Withdraw history</a>


                                </div>

                                <div class="col-sm-4 ">
                                    <a href=""   class="btn btn-primary btn-block me-1 mb-3">Interest history</a>


                                </div>

                                <div class="col-sm-4  ">
                                    <a href=""   class="btn btn-primary btn-block me-1 mb-3">Ref. commission history</a>


                                </div>


                            </div>


                            <form class="form form-vertical" action="{{route('admin.user.update',$user->id) }}" method="POST" enctype="multipart/form-data" >
                                    @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical"> Name</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                name="name" value="{{ $user->name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Username</label>
                                                <input type="text" id="email-id-vertical" class="form-control"
                                                name="username" value="{{ $user->username }}" required>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">Mobile</label>
                                                <input type="number" id="contact-info-vertical" class="form-control"
                                                name="phone" value="{{ $user->phone }}" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Email</label>
                                                <input type="email" id="email-id-vertical" class="form-control"
                                                name="email" value="{{ $user->email }}" required >
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">Address</label>
                                                <input type="text" id="contact-info-vertical" class="form-control"
                                                name="address" value="{{ @$user->address->address }}" >
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">Country</label>
                                                <select name="country" class="form-select" >
                                                    <option value="">Select Country</option>
                                                    <option value="Afghanistan"  @if (@$user->address->country == 'Afghanistan') selected @endif>Afghanistan</option>
                                                    <option value="Åland Islands" @if (@$user->address->country == 'Åland Islands') selected @endif >Åland Islands</option>
                                                    <option value="Albania" @if (@$user->address->country == 'Albania') selected @endif>Albania</option>
                                                    <option value="Algeria" @if (@$user->address->country == 'Algeria') selected @endif>Algeria</option>
                                                    <option value="American Samoa" @if (@$user->address->country == 'American Samoa') selected @endif>American Samoa</option>
                                                    <option value="Andorra" @if (@$user->address->country == 'Andorra') selected @endif>Andorra</option>
                                                    <option value="Angola" @if (@$user->address->country == 'Angola') selected @endif>Angola</option>
                                                    <option value="Anguilla" @if (@$user->address->country == 'Anguilla') selected @endif>Anguilla</option>
                                                    <option value="Antarctica" @if (@$user->address->country == 'Antarctica') selected @endif>Antarctica</option>
                                                    <option value="Antigua and Barbuda" @if (@$user->address->country == 'Antigua and Barbuda') selected @endif>Antigua and Barbuda</option>
                                                    <option value="Argentina" @if (@$user->address->country == 'Argentina') selected @endif>Argentina</option>
                                                    <option value="Armenia" @if (@$user->address->country == 'Armenia') selected @endif>Armenia</option>
                                                    <option value="Aruba" @if (@$user->address->country == 'Aruba') selected @endif>Aruba</option>
                                                    <option value="Australia" @if (@$user->address->country == 'Australia') selected @endif>Australia</option>
                                                    <option value="Austria" @if (@$user->address->country == 'Austria') selected @endif>Austria</option>
                                                    <option value="Azerbaijan" @if (@$user->address->country == 'Azerbaijan') selected @endif>Azerbaijan</option>
                                                    <option value="Bahamas" @if (@$user->address->country == 'Bahamas') selected @endif>Bahamas</option>
                                                    <option value="Bahrain" @if (@$user->address->country == 'Bahrain') selected @endif>Bahrain</option>
                                                    <option value="Bangladesh" @if (@$user->address->country == 'Bangladesh') selected @endif>Bangladesh</option>
                                                    <option value="Barbados">Barbados</option>
                                                    <option value="Belarus">Belarus</option>
                                                    <option value="Belgium">Belgium</option>
                                                    <option value="Belize">Belize</option>
                                                    <option value="Benin">Benin</option>
                                                    <option value="Bermuda">Bermuda</option>
                                                    <option value="Bhutan">Bhutan</option>
                                                    <option value="Bolivia">Bolivia</option>
                                                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                    <option value="Botswana">Botswana</option>
                                                    <option value="Bouvet Island">Bouvet Island</option>
                                                    <option value="Brazil">Brazil</option>
                                                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                    <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                    <option value="Bulgaria">Bulgaria</option>
                                                    <option value="Burkina Faso">Burkina Faso</option>
                                                    <option value="Burundi">Burundi</option>
                                                    <option value="Cambodia">Cambodia</option>
                                                    <option value="Cameroon">Cameroon</option>
                                                    <option value="Canada">Canada</option>
                                                    <option value="Cape Verde">Cape Verde</option>
                                                    <option value="Cayman Islands">Cayman Islands</option>
                                                    <option value="Central African Republic">Central African Republic</option>
                                                    <option value="Chad">Chad</option>
                                                    <option value="Chile">Chile</option>
                                                    <option value="China">China</option>
                                                    <option value="Christmas Island">Christmas Island</option>
                                                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                    <option value="Colombia">Colombia</option>
                                                    <option value="Comoros">Comoros</option>
                                                    <option value="Congo">Congo</option>
                                                    <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                                    <option value="Cook Islands">Cook Islands</option>
                                                    <option value="Costa Rica">Costa Rica</option>
                                                    <option value="Cote D'ivoire">Cote D'ivoire</option>
                                                    <option value="Croatia">Croatia</option>
                                                    <option value="Cuba">Cuba</option>
                                                    <option value="Cyprus">Cyprus</option>
                                                    <option value="Czech Republic">Czech Republic</option>
                                                    <option value="Denmark">Denmark</option>
                                                    <option value="Djibouti">Djibouti</option>
                                                    <option value="Dominica">Dominica</option>
                                                    <option value="Dominican Republic">Dominican Republic</option>
                                                    <option value="Ecuador">Ecuador</option>
                                                    <option value="Egypt">Egypt</option>
                                                    <option value="El Salvador">El Salvador</option>
                                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                    <option value="Eritrea">Eritrea</option>
                                                    <option value="Estonia">Estonia</option>
                                                    <option value="Ethiopia">Ethiopia</option>
                                                    <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                                    <option value="Faroe Islands">Faroe Islands</option>
                                                    <option value="Fiji">Fiji</option>
                                                    <option value="Finland">Finland</option>
                                                    <option value="France">France</option>
                                                    <option value="French Guiana">French Guiana</option>
                                                    <option value="French Polynesia">French Polynesia</option>
                                                    <option value="French Southern Territories">French Southern Territories</option>
                                                    <option value="Gabon">Gabon</option>
                                                    <option value="Gambia">Gambia</option>
                                                    <option value="Georgia">Georgia</option>
                                                    <option value="Germany">Germany</option>
                                                    <option value="Ghana">Ghana</option>
                                                    <option value="Gibraltar">Gibraltar</option>
                                                    <option value="Greece">Greece</option>
                                                    <option value="Greenland">Greenland</option>
                                                    <option value="Grenada">Grenada</option>
                                                    <option value="Guadeloupe">Guadeloupe</option>
                                                    <option value="Guam">Guam</option>
                                                    <option value="Guatemala">Guatemala</option>
                                                    <option value="Guernsey">Guernsey</option>
                                                    <option value="Guinea">Guinea</option>
                                                    <option value="Guinea-bissau">Guinea-bissau</option>
                                                    <option value="Guyana">Guyana</option>
                                                    <option value="Haiti">Haiti</option>
                                                    <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                                    <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                                    <option value="Honduras">Honduras</option>
                                                    <option value="Hong Kong">Hong Kong</option>
                                                    <option value="Hungary">Hungary</option>
                                                    <option value="Iceland">Iceland</option>
                                                    <option value="India" @if (@$user->address->country == 'Australia') selected @endif>India</option>
                                                    <option value="Indonesia">Indonesia</option>
                                                    <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                                    <option value="Iraq">Iraq</option>
                                                    <option value="Ireland">Ireland</option>
                                                    <option value="Isle of Man">Isle of Man</option>
                                                    <option value="Israel">Israel</option>
                                                    <option value="Italy">Italy</option>
                                                    <option value="Jamaica">Jamaica</option>
                                                    <option value="Japan">Japan</option>
                                                    <option value="Jersey">Jersey</option>
                                                    <option value="Jordan">Jordan</option>
                                                    <option value="Kazakhstan">Kazakhstan</option>
                                                    <option value="Kenya">Kenya</option>
                                                    <option value="Kiribati">Kiribati</option>
                                                    <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                                    <option value="Korea, Republic of">Korea, Republic of</option>
                                                    <option value="Kuwait">Kuwait</option>
                                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                    <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                                    <option value="Latvia">Latvia</option>
                                                    <option value="Lebanon">Lebanon</option>
                                                    <option value="Lesotho">Lesotho</option>
                                                    <option value="Liberia">Liberia</option>
                                                    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                                    <option value="Liechtenstein">Liechtenstein</option>
                                                    <option value="Lithuania">Lithuania</option>
                                                    <option value="Luxembourg">Luxembourg</option>
                                                    <option value="Macao">Macao</option>
                                                    <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                                    <option value="Madagascar">Madagascar</option>
                                                    <option value="Malawi">Malawi</option>
                                                    <option value="Malaysia">Malaysia</option>
                                                    <option value="Maldives">Maldives</option>
                                                    <option value="Mali">Mali</option>
                                                    <option value="Malta">Malta</option>
                                                    <option value="Marshall Islands">Marshall Islands</option>
                                                    <option value="Martinique">Martinique</option>
                                                    <option value="Mauritania">Mauritania</option>
                                                    <option value="Mauritius">Mauritius</option>
                                                    <option value="Mayotte">Mayotte</option>
                                                    <option value="Mexico">Mexico</option>
                                                    <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                                    <option value="Moldova, Republic of">Moldova, Republic of</option>
                                                    <option value="Monaco">Monaco</option>
                                                    <option value="Mongolia">Mongolia</option>
                                                    <option value="Montenegro">Montenegro</option>
                                                    <option value="Montserrat">Montserrat</option>
                                                    <option value="Morocco">Morocco</option>
                                                    <option value="Mozambique">Mozambique</option>
                                                    <option value="Myanmar">Myanmar</option>
                                                    <option value="Namibia">Namibia</option>
                                                    <option value="Nauru">Nauru</option>
                                                    <option value="Nepal">Nepal</option>
                                                    <option value="Netherlands">Netherlands</option>
                                                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                                                    <option value="New Caledonia">New Caledonia</option>
                                                    <option value="New Zealand">New Zealand</option>
                                                    <option value="Nicaragua">Nicaragua</option>
                                                    <option value="Niger">Niger</option>
                                                    <option value="Nigeria">Nigeria</option>
                                                    <option value="Niue">Niue</option>
                                                    <option value="Norfolk Island">Norfolk Island</option>
                                                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                    <option value="Norway">Norway</option>
                                                    <option value="Oman">Oman</option>
                                                    <option value="Pakistan">Pakistan</option>
                                                    <option value="Palau">Palau</option>
                                                    <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                                    <option value="Panama">Panama</option>
                                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                                    <option value="Paraguay">Paraguay</option>
                                                    <option value="Peru">Peru</option>
                                                    <option value="Philippines">Philippines</option>
                                                    <option value="Pitcairn">Pitcairn</option>
                                                    <option value="Poland">Poland</option>
                                                    <option value="Portugal">Portugal</option>
                                                    <option value="Puerto Rico">Puerto Rico</option>
                                                    <option value="Qatar">Qatar</option>
                                                    <option value="Reunion">Reunion</option>
                                                    <option value="Romania">Romania</option>
                                                    <option value="Russian Federation">Russian Federation</option>
                                                    <option value="Rwanda">Rwanda</option>
                                                    <option value="Saint Helena">Saint Helena</option>
                                                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                    <option value="Saint Lucia">Saint Lucia</option>
                                                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                    <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                                    <option value="Samoa">Samoa</option>
                                                    <option value="San Marino">San Marino</option>
                                                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                                    <option value="Senegal">Senegal</option>
                                                    <option value="Serbia">Serbia</option>
                                                    <option value="Seychelles">Seychelles</option>
                                                    <option value="Sierra Leone">Sierra Leone</option>
                                                    <option value="Singapore">Singapore</option>
                                                    <option value="Slovakia">Slovakia</option>
                                                    <option value="Slovenia">Slovenia</option>
                                                    <option value="Solomon Islands">Solomon Islands</option>
                                                    <option value="Somalia">Somalia</option>
                                                    <option value="South Africa">South Africa</option>
                                                    <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                                    <option value="Spain">Spain</option>
                                                    <option value="Sri Lanka">Sri Lanka</option>
                                                    <option value="Sudan">Sudan</option>
                                                    <option value="Suriname">Suriname</option>
                                                    <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                                    <option value="Swaziland">Swaziland</option>
                                                    <option value="Sweden">Sweden</option>
                                                    <option value="Switzerland">Switzerland</option>
                                                    <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                                    <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                                    <option value="Tajikistan">Tajikistan</option>
                                                    <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                                    <option value="Thailand">Thailand</option>
                                                    <option value="Timor-leste">Timor-leste</option>
                                                    <option value="Togo">Togo</option>
                                                    <option value="Tokelau">Tokelau</option>
                                                    <option value="Tonga">Tonga</option>
                                                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                    <option value="Tunisia">Tunisia</option>
                                                    <option value="Turkey">Turkey</option>
                                                    <option value="Turkmenistan">Turkmenistan</option>
                                                    <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                    <option value="Tuvalu">Tuvalu</option>
                                                    <option value="Uganda">Uganda</option>
                                                    <option value="Ukraine">Ukraine</option>
                                                    <option value="United Arab Emirates" @if (@$user->address->country == 'United Arab Emirates') selected @endif>United Arab Emirates</option>
                                                    <option value="United Kingdom" @if (@$user->address->country == 'United Kingdom') selected @endif>United Kingdom</option>
                                                    <option value="United States" @if (@$user->address->country == 'United States') selected @endif>United States</option>
                                                    <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                                    <option value="Uruguay">Uruguay</option>
                                                    <option value="Uzbekistan">Uzbekistan</option>
                                                    <option value="Vanuatu">Vanuatu</option>
                                                    <option value="Venezuela">Venezuela</option>
                                                    <option value="Viet Nam">Viet Nam</option>
                                                    <option value="Virgin Islands, British">Virgin Islands, British</option>
                                                    <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                                                    <option value="Western Sahara">Western Sahara</option>
                                                    <option value="Yemen">Yemen</option>
                                                    <option value="Zambia">Zambia</option>
                                                    <option value="Zimbabwe">Zimbabwe</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">State</label>
                                                <input type="text" id="contact-info-vertical" class="form-control"
                                                name="state" value="{{ @$user->address->state }}" >
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">City</label>
                                                <input type="text" id="contact-info-vertical" class="form-control"
                                                name="city" value="{{ @$user->address->city }}" >
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">Zip/Postal</label>
                                                <input type="text" id="contact-info-vertical" class="form-control"
                                                name="zip" value="{{ @$user->address->zip }}" >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Email Verify </label>
                                                <div class="selectgroup w-100">
                                                    <input type="radio" class="btn-check " name="email_verify" id="success-outlined"
                                                    autocomplete="off" value="1" {{ $user->email_verify == '1' ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-success btn-block " for="success-outlined">Verified</label>

                                                <input type="radio" class="btn-check" name="email_verify" id="danger-outlined"
                                                    autocomplete="off" value="0" {{ $user->email_verify != '1' ? 'checked' : '' }}  >
                                                <label class="btn btn-outline-danger btn-block "  for="danger-outlined"> Unverified</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Sms Verify </label>
                                                <div class="selectgroup w-100 ">
                                                    <input type="radio" class="btn-check " name="sms_verify" id="sms-verify-true"
                                                    autocomplete="off" value="1" {{ $user->sms_verify == '1' ? 'checked' : '' }} >
                                                        <label class="btn btn-outline-success btn-block  " for="sms-verify-true">Verified</label>

                                                <input type="radio" class="btn-check" name="sms_verify" id="sms-verify-false"
                                                    autocomplete="off" value="0" {{ $user->sms_verify != '1' ? 'checked' : '' }} >
                                                <label class="btn btn-outline-danger btn-block  "  for="sms-verify-false"> Unverified</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">2FA Status </label>
                                                <div class="selectgroup w-100">
                                                    <input type="radio" class="btn-check " name="two_fa_status" id="on"
                                                    autocomplete="off" value="1" {{ $user->ts == '1' ? 'checked' : '' }}  >
                                                <label class="btn btn-outline-success btn-block " for="on">On</label>

                                                <input type="radio" class="btn-check" name="two_fa_status" id="off"
                                                    autocomplete="off" value="0" {{ $user->ts != '1' ? 'checked' : '' }} >
                                                <label class="btn btn-outline-danger btn-block "  for="off"> Off</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">2FA Verification</label>
                                                <div class="selectgroup w-100">
                                                    <input type="radio" class="btn-check " name="two_fa_verify" id="2fa-verification-on"
                                                    autocomplete="off" value="1"  @if($user->tv == 1)    checked=""  @endif  >
                                                <label class="btn btn-outline-success btn-block " for="2fa-verification-on">Verified</label>

                                                <input type="radio" class="btn-check" name="two_fa_verify" id="2fa-verification-off"
                                                    autocomplete="off" value="0" @if($user->tv != 1)    checked=""  @endif >
                                                <label class="btn btn-outline-danger btn-block "  for="2fa-verification-off"> Unverified</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">Status</label>
                                                <select name="status"  class="form-select" >
                                                    <option value="1"@if ($user->status == '1') selected @endif>Active</option>
                                                    <option value="0"@if ($user->status == '0') selected @endif>Block</option>
                                                    <option value="2"@if ($user->status == '2') selected @endif>Pending</option>

                                                </select>
                                            </div>
                                        </div>
                                            <button type="submit" class="btn btn-success me-1 mb-1">Update</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                        <div class="modal fade text-left" id="addModal" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel1">Edit </h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="{{ route('admin.user.addbalance',$user->id) }} " method="post">
                                @csrf
                                {{-- @method('put') --}}

                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="basicInput">Amount</label>
                                            <input type="text" name="amount" id="amount" class="form-control form-control-lg"  placeholder="Enter Amount" >
                                        </div>
                                    </div>
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Close</span>
                                        </button>
                                        <button type="submit" class="btn btn-primary ml-1" >
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Update</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- Subtraction --}}
                    <div class="modal fade text-left" id="subModal" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel2" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel2">Subtract Amount </h5>
                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form action="{{ route('admin.user.subbalance',$user->id) }} " method="post">
                            @csrf
                            {{-- @method('put') --}}

                            <div class="modal-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="basicInput">Amount</label>
                                        <input type="text" name="amount" id="amount" class="form-control form-control-lg"  placeholder="Enter Positive Amount" >
                                    </div>
                                </div>
                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                    <button type="submit" class="btn btn-danger ml-1" >
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Subtract</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    </section>
    </div>
    <style>
        /* Custom CSS class to change card color */
        .custom-card {
            background-color: #62b928; /* Change this to your desired color */
            color: white; /* Change text color to contrast with the background */
        }
        .custom-card2 {
            background-color: #5b3bdf; /* Change this to your desired color */
            color: white; /* Change text color to contrast with the background */
        }
        .custom-card3 {
            background-color: #c21aec; /* Change this to your desired color */
            color: white; /* Change text color to contrast with the background */
        }

        .custom-card4 {
            background-color: #1585d6; /* Change this to your desired color */
            color: white; /* Change text color to contrast with the background */
        }
    </style>
@endsection

