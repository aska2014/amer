<div class="main-title">
    <a href="#">شقق للإيجار فى القاهرة</a>
</div>

<form role="form" class="form-horizontal" method="POST" action="{{ URL::route('add-estate') }}">
    <div class="form-group">
        <label for="text">عنوان الأعلان</label>
        <input class="form-control" type="text" id="text" name="Estate[title]"
               placeholder="هذا الحقل لعنوان نص الاعلان وليس لعنوان المكان">
    </div>
    <div class="form-group">
        <label for="text">المكان</label>
        <input class="form-control" type="text" id="text" name="Estate[place]">
    </div>
    <div class="form-group">
        <label for="text">الحى \ المنطقه</label>
        <input class="form-control" type="text" id="text" name="Estate[region]">
    </div>
    <div class="form-group">
        <label for="text">نوع العقار</label>
        <select class="form-control" name="Estate[estate_category_id]">
            @foreach($estateCategories as $category)
            <option value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="text">عدد الغرف</label>
        <select class="form-control" name="Estate[number_of_rooms]">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select>
    </div>
    <div class="form-group">
        <label for="text">الخدمة المطلوبه</label>
        <select class="form-control" name="Estate[type]">
            @foreach($estateTypes as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="text">المساحة</label>
        <input class="form-control" type="text" id="text" name="Estate[area]" >
    </div>
    <div class="form-group">
        <label for="text">نص الاعلان</label>
        <textarea class="form-control" name="Estate[description]"></textarea>
    </div>
    <div class="form-group">
        <label for="text">صورة الاعلان</label>
        <div class="two-inputs">
            <input type="file" name="estate-img"/>
        </div>
    </div>
    <div class="form-group">
        <label for="text">السعر</label>
        <input class="form-control" type="text" id="text" name="Estate[price]" >
<!--        <div class="two-inputs">-->
<!--            <input class="form-control" type="text" id="text" name="text"  placeholder="الأدنى">-->
<!--            <input class="form-control" type="text" id="text" name="text"  placeholder="الأعلى">-->
<!--        </div>-->
    </div>
    <div class="form-group">
        <label for="text">اسم صاحب الاعلان</label>
        <input class="form-control" type="text" id="text" name="UserInfo[name]" >
    </div>
    <div class="form-group">
        <label for="text">رقم الموبيل</label>
        <input class="form-control" type="text" id="text" name="UserInfo[mobile_number]" >
    </div>
    <div class="form-group">
        <label for="text">رقم الهاتف</label>
        <input class="form-control" type="text" id="text" name="UserInfo[telephone_number]" >
    </div>
    <div class="form-group">
        <label for="text">البريد الإلكترونى</label>
        <input class="form-control" type="email" id="text" name="UserInfo[contact_email]" >
    </div>

    <div class="buttons">
        <button type="submit" class="btn btn-success">التالى</button>
    </div>
</form>