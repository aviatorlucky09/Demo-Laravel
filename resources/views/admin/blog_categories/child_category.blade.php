<option value="{{ $child_category->id }}" class="optionChild" style="padding-left: 15px" @if($child_category->id == $obj->parent_category_id) selected @endif
              @if($obj->id == $childCategory->id) disabled @endif>{{ $child_category->name }}</option>
@if ($child_category->categories)
	 @foreach ($child_category->categories as $childCategory)
            @include('admin.blog_categories.child_category', ['child_category' => $childCategory])
        @endforeach
@endif