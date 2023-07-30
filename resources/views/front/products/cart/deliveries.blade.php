@if (count($deliveryAddress)>0)
<h4 class="section-h4">Alamat Penyewa</h4>
@foreach ($deliveryAddress as $alamat)
<div class="control-group" style="float: left; margin-right: 5px;"><input type="radio" id="address{{ $alamat['id'] }}"
        name="address_id" value="{{ $alamat['id'] }}"></div>
<div class="control-label">{{ $alamat['nama'] }},
    {{ $alamat['alamat'] }}, ({{ $alamat['no_hp'] }}), {{ $alamat['kecamatan'] }}, {{
    $alamat['kota'] }},
    {{ $alamat['provinsi'] }}, {{ $alamat['kode_pos'] }}
    <a href="javascript:;" data-addressid="{{ $alamat['id'] }}" style="float: right;" class="editAddress">
        Edit
    </a>
</div>
@endforeach<br>
<div class="u-s-m-b-24">
    <h4 class="section-h4">Edit Alamat Penyewa</h4>
    <input type="checkbox" class="label-text" for="ship-to-different-address" data-bs-toggle="collapse"
        data-bs-target="#showdifferent" aria-expanded="false" aria-controls="showdifferent">
    <label class="label-text" for="ship-to-different-address">Ship to a different
        address?</label>
</div>
<hr>
<div class="card">
    <div class="card-body">
        <div class="u-s-m-b-24 pt-3">
            <p class="text-center">Before clicking the button below, Edit data:</p>
            <hr>
            <div class="collapse" id="showdifferent">
                <!-- Form-Fields -->
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
@else
<h4 class="section-h4">Tambah Alamat Penyewa</h4>
<div class="group-inline u-s-m-b-13">
    <div class="group-1 u-s-p-r-16">
        <label for="first-name">First Name
            <span class="astk">*</span>
        </label>
        <input type="text" id="first-name" class="text-field">
    </div>
    <div class="group-2">
        <label for="last-name">Last Name
            <span class="astk">*</span>
        </label>
        <input type="text" id="last-name" class="text-field">
    </div>
</div>
<div class="u-s-m-b-13">
    <label for="select-country">Country
        <span class="astk">*</span>
    </label>
    <div class="select-box-wrapper">
        <select class="select-box" id="select-country">
            <option selected="selected" value="">Choose your country...</option>
            <option value="">United Kingdom (UK)</option>
            <option value="">United States (US)</option>
            <option value="">United Arab Emirates (UAE)</option>
        </select>
    </div>
</div>
<div class="street-address u-s-m-b-13">
    <label for="req-st-address">Street Address
        <span class="astk">*</span>
    </label>
    <input type="text" id="req-st-address" class="text-field" placeholder="House name and street name">
    <label class="sr-only" for="opt-st-address"></label>
    <input type="text" id="opt-st-address" class="text-field" placeholder="Apartment, suite unit etc. (optional)">
</div>
<div class="u-s-m-b-13">
    <label for="town-city">Town / City
        <span class="astk">*</span>
    </label>
    <input type="text" id="town-city" class="text-field">
</div>
<div class="u-s-m-b-13">
    <label for="select-state">State / Country
        <span class="astk"> *</span>
    </label>
    <div class="select-box-wrapper">
        <select class="select-box" id="select-state">
            <option selected="selected" value="">Choose your state...</option>
            <option value="">Alabama</option>
            <option value="">Alaska</option>
            <option value="">Arizona</option>
        </select>
    </div>
</div>
<div class="u-s-m-b-13">
    <label for="postcode">Postcode / Zip
        <span class="astk">*</span>
    </label>
    <input type="text" id="postcode" class="text-field">
</div>
<div class="group-inline u-s-m-b-13">
    <div class="group-1 u-s-p-r-16">
        <label for="email">Email address
            <span class="astk">*</span>
        </label>
        <input type="text" id="email" class="text-field">
    </div>
    <div class="group-2">
        <label for="phone">Phone
            <span class="astk">*</span>
        </label>
        <input type="text" id="phone" class="text-field">
    </div>
</div>
<div class="u-s-m-b-30">
    <input type="checkbox" class="check-box" id="create-account">
    <label class="label-text" for="create-account">Create Account</label>
</div>
@endif