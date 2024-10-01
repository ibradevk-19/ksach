<div>
    <div class="mb-3 row">
        <label for="full_name" class="col-md-2 col-form-label">الإسم</label>
        <div class="col-md-5">
            <input wire:model="full_name" class="form-control" placeholder="الإسم" type="text" value="{{old('full_name')}}" name="full_name" id="full_name">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="id_num" class="col-md-2 col-form-label">رقم الهوية</label>
        <div class="col-md-5">
            <input wire:model="id_num" class="form-control" placeholder="رقم الهوية" type="text" value="{{old('id_num')}}" name="id_num" id="id_num">
        </div>
        <div class="col-md-2">
               <button type="button" class="btn btn-md btn-secondary" wire:click="fullName()">فحص</button>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="wife_name" class="col-md-2 col-form-label">اسم الزوجة</label>
        <div class="col-md-5">
            <input wire:model="wife_name" class="form-control" placeholder="اسم الزوجة" type="text" value="{{old('wife_name')}}" name="wife_name" id="wife_name">
        </div>

    </div>
    <div class="mb-3 row">
        <label for="wife_id_num" class="col-md-2 col-form-label">رقم الهوية الزوجة</label>
        <div class="col-md-5">
            <input  wire:model="wife_id_num" class="form-control" placeholder="رقم الهوية الزوجة" type="text" value="{{old('wife_id_num')}}" name="wife_id_num" id="wife_id_num">
        </div>
        <div class="col-md-2">
            <div class="col-md-2">
                <button type="button" class="btn btn-md btn-secondary" wire:click="WfullName()">فحص</button>
            </div>

        </div>
    </div>
    <div class="mb-3 row">
        <label for="example-text-input" class="col-md-2 col-form-label">رقم الجوال </label>
        <div class="col-md-5">
            <input wire:model="mobile" class="form-control" placeholder="رقم الجوال " type="text" value="{{old('mobile')}}" name="mobile" id="example-text-input">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="example-text-input" class="col-md-2 col-form-label"> الحالة الاجتماعية </label>
        <div class="col-md-5">
          <select wire:model="marital_status" name="marital_status" class="form-select">
               <option>اختار الحالة الاجتماعية</option>
                  <option value="1">اعزب</option>
                  <option value="2">متزوج</option>
                  <option value="3">مطلق</option>
                  <option value="4">ارملة</option>
                  <option value="5">ارمل</option>
                  <option value="6">حالة اجتماعية</option>
                  <option value="7">اخر</option>
           </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="example-text-input" class="col-md-2 col-form-label"> عدد الافراد  </label>
        <div class="col-md-5">
            <input wire:model="family_count" class="form-control" placeholder=" عدد الافراد " type="number" value="{{old('family_count')}}" name="family_count" id="example-text-input">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="example-text-input" class="col-md-2 col-form-label"> العائلة</label>
        <div class="col-md-5">
          <select wire:model="family_id" id="family_id" name="family_id" class="form-select">
               <option>اختار العائلة </option>
               @foreach($families as $family)
                  <option value="{{$family->id}}">{{ $family->name }}</option>
               @endforeach

           </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="example-text-input" class="col-md-2 col-form-label">  المندوب </label>
        <div class="col-md-5">
          <select wire:model="actor_id" id="actor_id" name="actor_id" class="form-select">
               <option>اختار المندوب </option>
               @foreach($actors as $actor)
                  <option value="{{$actor->id}}">{{ $actor->name }}</option>
               @endforeach
           </select>
        </div>
    </div>

</div>
