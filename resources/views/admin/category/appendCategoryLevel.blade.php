<div class="form-group">
    <label for="parent_id">Level Category</label>
    <select class="form-control" name="parent_id" id="parent_id">
        <option value="">Pilih Level Category</option>
        <option selected="" value="0" @if(isset($gC['parent_id']) && $gC['parent_id']==0) @endif>Main Category</option>
        @if(!empty($getCategory))
        @foreach ($getCategory as $gC)
        <option selected="" value="{{ $gC['id'] }}" @if(isset($gC['parent_id']) && $gC['parent_id']==0) @endif>{{ $gC['nama'] }}
        </option>
        @if(!empty($gC['subcategory']))
        @foreach ($gC['subcategory'] as $gS)
        <option selected="" value="{{ $gS['id'] }}" @if(isset($gC['parent_id']) && $gC['parent_id']==0) @endif>&nbsp;&raquo;&nbsp;{{ $gS['nama'] }}
        </option>
        @endforeach
        @endif
        @endforeach
        @endif
    </select>
</div>