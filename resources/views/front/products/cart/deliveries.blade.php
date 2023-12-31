<h4 class="section-h4 deliveryText">Alamat Penyewa</h4>
<div class="u-s-m-b-24">
    <input type="checkbox" class="label-text" for="ship-to-different-address" data-bs-toggle="collapse"
        data-bs-target="#showdifferent" aria-expanded="false" aria-controls="showdifferent">
    @if(count($deliveryAddresses) > 0)
    <label class="label-text newAddress" for="ship-to-different-address">Ship to a different
        address?</label>
    @else
    <label class="label-text newAddress" for="ship-to-different-address">check different
        address?</label>
    @endif
</div>
<hr>
<div class="u-s-m-b-24 pt-3">
    <p class="text-center">Before clicking the button below, Edit data:</p>
    <hr>
    <div class="collapse" id="showdifferent">
        <!-- Form-Fields -->
        <form id="addressEditForm" name="addressEditForm" action="javascript:;" method="POST">
            @csrf
            <input type="hidden" name="delivery_id" id="delivery_id">
            <div class="group-inline u-s-m-b-13">
                <div class="group-1 u-s-p-r-16">
                    <label for="nama">Name
                        <span class="astk">*</span>
                    </label>
                    <input type="text" name="delivery_nama" id="delivery_nama" class="text-field">
                    <p id="delivery-delivery_nama"></p>
                </div>
                <div class="group-2">
                    <label for="no_hp">No Hanphone
                        <span class="astk">*</span>
                    </label>
                    <input type="text" name="delivery_no_hp" id="delivery_no_hp" class="text-field">
                    <p id="delivery-delivery_no_hp"></p>
                </div>
            </div>
            <div class="u-s-m-b-13">
                <label for="kecamatan">Kecamatan
                    <span class="astk">*</span>
                </label>
                <input type="text" name="delivery_kecamatan" id="delivery_kecamatan" class="text-field"
                    placeholder="kecamatan anda">
                <p id="delivery-delivery_kecamatan"></p>
            </div>
            <div class="u-s-m-b-13">
                <label for="kota">Kota
                    <span class="astk">*</span>
                </label>
                <input type="text" name="delivery_kota" id="delivery_kota" class="text-field" placeholder="kota anda">
                <p id="delivery-delivery_kota"></p>
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
                    <p id="delivery-delivery_provinsi"></p>
                </div>
            </div>
            <div class="u-s-m-b-13">
                <label for="kode_pos">Kode Pos
                    <span class="astk">*</span>
                </label>
                <input type="text" name="delivery_kode_pos" id="delivery_kode_pos" class="text-field"
                    placeholder="Kode pos">
                <p id="delivery-delivery_kode_pos"></p>
            </div>
            <div class="u-s-m-b-13">
                <label for="alamat">Alamat
                    <span class="astk">*</span>
                </label>
                <input type="text" name="delivery_alamat" id="delivery_alamat" class="text-field" placeholder="alamat">
                <p id="delivery-delivery_alamat"></p>
            </div>
            <div class="u-s-m-b-13">
                <button style="width: 100%;" type="submit" class="button button-outline-secondary">Save</button>
            </div>
        </form>
    </div>
</div>