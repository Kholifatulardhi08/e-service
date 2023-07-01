<div class="form-group">
    <label for="parent_id">Level Category</label>
    <select class="form-control" name="parent_id" id="parent_id">
        <option selected="" value="0" @if(isset($category['parent_id']) && $category['parent_id']==0) @endif>Main Category</option>
        @if(!empty($getCategory))
        @foreach ($getCategory as $parentCategory)
        <option selected="" value="{{ $parentCategory['id'] }}" @if(isset($category['parent_id']) &&
            $category['nama']==$parentCategory['id']) @endif>{{ $parentCategory['nama'] }}
        </option>
        @if(!empty($parentCategory['subcategory']))
        @foreach ($parentCategory['subcategory'] as $gS)
        <option selected="" value="{{ $gS['id'] }}" @if(isset($gS['parent_id']) && $gS['parent_id']==$gS['id']) @endif>
            &nbsp;&raquo;&nbsp;{{ $gS['nama'] }}
        </option>
        @endforeach
        @endif
        @endforeach
        @endif
    </select>
</div>