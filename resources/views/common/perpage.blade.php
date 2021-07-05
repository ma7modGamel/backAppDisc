<form class="form-inline" method="GET" role="form" dir="{{ App::getLocale() == 'ar' ? 'rtl':'' }}">
    <div class="form-group">
        <label for="perPage">{{__('Count')}}:</label>
        <input hidden name="page" value="{{old('page')}}"/>
        <select class="form-control" id="perPage" name="perPage"  onchange="submit()">
            <option @if(old('perPage') == 5) selected @endif>5</option>
            <option @if(old('perPage') == 10) selected @endif>10</option>
            <option @if(old('perPage') == 15) selected @endif>15</option>
            <option @if(old('perPage') == 20) selected @endif>20</option>
            <option @if(old('perPage') == 25) selected @endif>25</option>
            <option @if(old('perPage') == 30) selected @endif>30</option>
        </select>
   </div>
</form>