@if (count($deliveryAddress)>0)
<h4 class="section-h4">Alamat User Details</h4>
@foreach ($deliveryAddress as $alamat)
<input type="radio" id="address{{ $alamat['id'] }}" name="address_id" value="{{ $alamat['id'] }}">
<a href="javascript:;" data-addressid="{{ $alamat['id'] }}" style="float: right;" class="editAddress">
    Edit
</a>
<div class="custom-label mb-3">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td><strong>Nama:</strong></td>
                <td>{{ $alamat['nama'] }}</td>
            </tr>
            <tr>
                <td><strong>No Hanphone:</strong></td>
                <td>{{ $alamat['no_hp'] }}</td>
            </tr>
            <tr>
                <td><strong>Alamat:</strong></td>
                <td>{{ $alamat['alamat'] }}</td>
            </tr>
            <tr>
                <td><strong>Kecamatan:</strong></td>
                <td>{{ $alamat['kecamatan'] }}</td>
            </tr>
            <tr>
                <td><strong>Kota:</strong></td>
                <td>{{ $alamat['kota'] }}</td>
            </tr>
            <tr>
                <td><strong>Provinsi:</strong></td>
                <td>{{ $alamat['provinsi'] }}</td>
            </tr>
            <tr>
                <td><strong>Kode Pos:</strong></td>
                <td>{{ $alamat['kode_pos'] }}</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="card">
    <div class="card-body">
        <div class="u-s-m-b-24 pt-3">
            <p class="newAddress text-center">Before clicking the button below, Edit data:</p>
            <div class="collapse" id="showdifferent">
                <!-- Form-Fields -->
                <h4>Edit Data</h4>
                <hr>
                <form id="addressEditForm" action="javascript:;" method="POST">
                    <div class="group-inline u-s-m-b-13">
                        <div class="group-1 u-s-p-r-16">
                            <label for="nama">Name
                                <span class="astk">*</span>
                            </label>
                            <input type="text" name="delivery_nama" id="delivery_nama" class="text-field">
                        </div>
                        <div class="group-2">
                            <label for="no_hp">No Hanphone
                                <span class="astk">*</span>
                            </label>
                            <input type="text" name="delivery_no_hp" id="delivery_no_hp" class="text-field">
                        </div>
                    </div>
                    <div class="u-s-m-b-13">
                        <label for="kecamatan">Kecamatan
                            <span class="astk">*</span>
                        </label>
                        <input type="text" name="delivery_kecamatan" id="delivery_kecamatan" class="text-field"
                            placeholder="kecamatan anda">
                    </div>
                    <div class="u-s-m-b-13">
                        <label for="kota">Kota
                            <span class="astk">*</span>
                        </label>
                        <input type="text" name="delivery_kota" id="delivery_kota" class="text-field"
                            placeholder="kota anda">
                    </div>
                    <div class="u-s-m-b-13">
                        <label for="provinsi">Provinsi
                            <span class="astk">*</span>
                        </label>
                        <div class="select-box-wrapper">
                            <select class="select-box" name="delivery_provinsi" id="delivery_provinsi">
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinsi as $items)
                                <option value="{{ $items['name'] }}">
                                    {{ $items['name'] }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="u-s-m-b-13">
                        <label for="kode_pos">Kode Pos
                            <span class="astk">*</span>
                        </label>
                        <input type="text" name="delivery_kode_pos" id="delivery_kode_pos" class="text-field"
                            placeholder="Kode pos">
                    </div>
                    <div class="u-s-m-b-13">
                        <button style="width: 100%;" id="delivery_btnShipping" type="submit"
                            class="button button-outline-secondary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<br>
@else
<h4 class="section-h4">Add Another Address Details</h4>
<div class="u-s-m-b-24">
    <input type="checkbox" class="check-box" id="ship-to-different-address">
    <label class="label-text" for="ship-to-different-address" data-bs-toggle="collapse" data-bs-target="#showdifferent"
        aria-expanded="false" aria-controls="showdifferent">Ship to a different
        address?</label>
</div>
<div class="collapse" id="showdifferent">
    <!-- Form-Fields -->
    <div class="group-inline u-s-m-b-13">
        <div class="group-1 u-s-p-r-16">
            <label for="first-name-extra">First Name
                <span class="astk">*</span>
            </label>
            <input type="text" id="first-name-extra" class="text-field">
        </div>
        <div class="group-2">
            <label for="last-name-extra">Last Name
                <span class="astk">*</span>
            </label>
            <input type="text" id="last-name-extra" class="text-field">
        </div>
    </div>
    <div class="u-s-m-b-13">
        <label for="select-country-extra">Country
            <span class="astk">*</span>
        </label>
        <div class="select-box-wrapper">
            <select class="select-box" id="select-country-extra">
                <option selected="selected" value="">Choose your country...</option>
                <option value="">United Kingdom (UK)</option>
                <option value="">United States (US)</option>
                <option value="">United Arab Emirates (UAE)</option>
            </select>
        </div>
    </div>
    <div class="street-address u-s-m-b-13">
        <label for="req-st-address-extra">Street Address
            <span class="astk">*</span>
        </label>
        <input type="text" id="req-st-address-extra" class="text-field" placeholder="House name and street name">
        <label class="sr-only" for="opt-st-address-extra"></label>
        <input type="text" id="opt-st-address-extra" class="text-field"
            placeholder="Apartment, suite unit etc. (optional)">
    </div>
    <div class="u-s-m-b-13">
        <label for="town-city-extra">Town / City
            <span class="astk">*</span>
        </label>
        <input type="text" id="town-city-extra" class="text-field">
    </div>
    <div class="u-s-m-b-13">
        <label for="select-state-extra">State / Country
            <span class="astk"> *</span>
        </label>
        <div class="select-box-wrapper">
            <select class="select-box" id="select-state-extra">
                <option selected="selected" value="">Choose your state...</option>
                <option value="">Alabama</option>
                <option value="">Alaska</option>
                <option value="">Arizona</option>
            </select>
        </div>
    </div>
    <div class="u-s-m-b-13">
        <label for="postcode-extra">Postcode / Zip
            <span class="astk">*</span>
        </label>
        <input type="text" id="postcode-extra" class="text-field">
    </div>
    <div class="group-inline u-s-m-b-13">
        <div class="group-1 u-s-p-r-16">
            <label for="email-extra">Email address
                <span class="astk">*</span>
            </label>
            <input type="text" id="email-extra" class="text-field">
        </div>
        <div class="group-2">
            <label for="phone-extra">Phone
                <span class="astk">*</span>
            </label>
            <input type="text" id="phone-extra" class="text-field">
        </div>
    </div>
    <!-- Form-Fields /- -->
</div>
<div>
    <label for="order-notes">Order Notes</label>
    <textarea class="text-area" id="order-notes"
        placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
</div>
@endif