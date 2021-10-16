@include("components.header")

  <div id="app">
    <div class="container mt-4">
      <div class="row g-4">
        <div class="col-md-6 offset-md-3">
          <div class="card">
            <div class="card-header bg-primary text-white">
              <h2 class="m-0">アンケート概要</h2>
            </div>
            <div class="card-body">
              本日は、ご協力いただき誠にありがとうございます。<br>
              様々な方からのご意見を参考にさせていただきたいので、ご協力くださいますよう宜しくお願いいたします。
            </div>
          </div>
        </div>
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <div class="col-md-6 offset-md-3">
          <div class="card">
            <div class="card-header">
              <b>あなたの性別をお答えください。</b>
            </div>
            <div class="card-body">
              <div class="form-check">
                <input v-model="forms.gender" value="男" class="form-check-input" type="radio" name="gender" id="genderMan">
                <label class="form-check-label" for="genderMan">男</label>
              </div>
              <div class="form-check">
                <input v-model="forms.gender" value="女" class="form-check-input" type="radio" name="gender" id="genderWoman">
                <label class="form-check-label" for="genderWoman">女</label>
              </div>
              <ul v-if="errors.gender.length > 0" class="error">
                <li v-for="(v, k) in errors.gender" :key="k" v-text="v"></li>
              </ul>
              <div class="d-flex justify-content-end">
                <ul class="notice">
                  <li>必須</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 offset-md-3">
          <div class="card">
            <div class="card-header">
              <b>ご年齢についてお答えください。</b>
            </div>
            <div class="card-body">
              <div class="form-check">
                <input v-model="forms.age" value="10代" class="form-check-input" type="radio" name="age" id="age10">
                <label class="form-check-label" for="age10">10代</label>
              </div>
              <div class="form-check">
                <input v-model="forms.age" value="20代" class="form-check-input" type="radio" name="age" id="age20">
                <label class="form-check-label" for="age20">20代</label>
              </div>
              <div class="form-check">
                <input v-model="forms.age" value="30代" class="form-check-input" type="radio" name="age" id="age30">
                <label class="form-check-label" for="age30">30代</label>
              </div>
              <div class="form-check">
                <input v-model="forms.age" value="40代" class="form-check-input" type="radio" name="age" id="age40">
                <label class="form-check-label" for="age40">40代</label>
              </div>
              <div class="form-check">
                <input v-model="forms.age" value="50代" class="form-check-input" type="radio" name="age" id="age50">
                <label class="form-check-label" for="age50">50代</label>
              </div>
              <div class="form-check">
                <input v-model="forms.age" value="60代" class="form-check-input" type="radio" name="age" id="age60">
                <label class="form-check-label" for="age60">60代</label>
              </div>
              <div class="form-check">
                <input v-model="forms.age" value="70代以上" class="form-check-input" type="radio" name="age" id="age70">
                <label class="form-check-label" for="age70">70代以上</label>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 offset-md-3">
          <div class="card">
            <div class="card-header">
              <b>お住まいの地域についてお答えください。</b>
            </div>
            <div class="card-body">
              <select name="pref" v-model="forms.pref" @blur="judgePref()" class="form-control">
                <option value="">選択してください</option>
                <?php $pref = getPrefArr(); ?>
                <?php foreach ($pref as $k => $v) { ?>
                  <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                <?php } ?>
              </select>
              <ul v-if="errors.pref.length > 0" class="error">
                <li v-for="(v, k) in errors.pref" :key="k" v-text="v"></li>
              </ul>
              <div class="d-flex justify-content-end mt-2">
                <ul class="notice">
                  <li>必須</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 offset-md-3">
          <div class="card">
            <div class="card-header">
              <b>あなたが求める宿泊施設の設備等について教えてください。</b>
            </div>
            <div class="card-body">
              <div class="form-check">
                <input v-model="forms.facilitys" class="form-check-input" type="checkbox" value="24時間対応" id="24hour">
                <label class="form-check-label" for="24hour">24時間対応</label>
              </div>
              <div class="form-check">
                <input v-model="forms.facilitys" class="form-check-input" type="checkbox" value="駐車場" id="parking">
                <label class="form-check-label" for="parking">駐車場</label>
              </div>
              <div class="form-check">
                <input v-model="forms.facilitys" class="form-check-input" type="checkbox" value="コンビニ" id="conveni">
                <label class="form-check-label" for="conveni">コンビニ</label>
              </div>
              <div class="form-check">
                <input v-model="forms.facilitys" class="form-check-input" type="checkbox" value="食事付き" id="foods">
                <label class="form-check-label" for="foods">食事付き</label>
              </div>
              <div class="form-check">
                <input v-model="forms.facilitys" class="form-check-input" type="checkbox" value="ネット付き" id="net">
                <label class="form-check-label" for="net">ネット付き</label>
              </div>
              <div class="form-check">
                <input v-model="forms.facilitys" class="form-check-input" type="checkbox" value="防犯設備" id="security">
                <label class="form-check-label" for="security">防犯設備</label>
              </div>
              <div class="form-check">
                <input v-model="forms.facilitys" class="form-check-input" type="checkbox" value="その他" id="facilitysOther">
                <label class="form-check-label" for="facilitysOther">その他</label>
              </div>
              <div v-if="forms.facilitysBool" class="ps-4 mb-2">
                <input v-model="forms.facilitysOther" type="text" class="form-control">
              </div>
              <ul v-if="errors.facilitys.length > 0" class="error">
                <li v-for="(v, k) in errors.facilitys" :key="k" v-text="v"></li>
              </ul>
              <div class="d-flex justify-content-end">
                <ul class="notice">
                  <li>必須</li>
                  <li>３つ以内</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <button
        type="button"
        class="btn btn-primary text-white fw-bold d-block mx-auto px-5 py-2 mt-5"
        :disabled="disabledSubmit"
        @click="submit()"
      >
        送信する
      </button>

    </div><!-- /.container -->
  </div>

  <!-- <script src="{{ asset('js/vue.global.prod.js') }}"></script> -->
  <script src="{{ asset('js/vue.global.js') }}"></script>
  <script>
    const app = {
      data() {
        return {
          forms: {
            gender: "",
            age: "",
            pref: "",
            facilitys: [],
            facilitysBool: false,
            facilitysOther: "",
          },
          validations:{
            gender: true,
            age: false,
            pref: true,
            facilitys: true,
          },
          errors: {
            gender: [],
            pref: [],
            facilitys: [],
          },
          notice: {
            must: "入力してください",
            count3: "３つ以内でおねがいします"
          },
          disabledSubmit: true,
        }
      },
      methods: {
        submit() {
          let ajaxUrl = '/add';
          let params = new URLSearchParams();
          params.append('forms', JSON.stringify(this.forms));
          const param = {
            method: "POST",
            body: params,
            headers: {
              'X-CSRF-TOKEN': document.getElementsByName("csrf-token")[0].content
            },
          }
          fetch(ajaxUrl, param)
            .then(res => res.json())
            .then(res => {
              if (res.errors) {
                let str = "入力ミスのようです\n"
                for(var i in res.errors){
                  str = str + res.errors[i] + "\n"
                }
                alert(str)
              }else{
                // alert("送信完了しました。\nご協力まことにありがとうございました。");
                location.href = "/thanks";
              }
            })
            .catch(error => {
              alert("送信エラーが発生しましたので、\n入力内容を確認・修正後に再度送信してみてください\n" + error);
              // location.href = "/";
            });
        },
        checkEmpty(e){
          return e === "" ? true : false
        },
        checkEmptyArr(e){
          return e.length === 0 ? true : false
        },
        checkCount3(e){
          return e.length > 3 ? true : false
        },
        judgeGender(){
          let vali = false
          const arr = []
          if (this.checkEmpty(this.forms.gender)) {
            arr.push(this.notice.must)
            vali = true
          }
          this.errors.gender = arr
          this.validations.gender = vali
          this.judgeSubmit()
        },
        judgePref(){
          let vali = false
          const arr = []
          if (this.checkEmpty(this.forms.pref)) {
            arr.push(this.notice.must)
            vali = true
          }
          this.errors.pref = arr
          this.validations.pref = vali
          this.judgeSubmit()
        },
        judgeFacilitys(){
          let vali = false
          let value = this.forms.facilitys
          this.forms.facilitysBool = false
          for (const v of value) {
            if ( v === "その他" ) {
              this.forms.facilitysBool = true
            }
          }
          const arr = []
          if (this.checkEmptyArr(this.forms.facilitys)) {
            arr.push(this.notice.must)
            vali = true
          }
          if (this.checkCount3(this.forms.facilitys)) {
            arr.push(this.notice.count3)
            vali = true
          }

          this.errors.facilitys = arr
          this.validations.facilitys = vali
          this.judgeSubmit()
        },
        judgeSubmit(){
          let res = false
          const validations = this.validations
          for (const e in validations) {
            if(validations[e]) res = true
          }
          const errors = this.errors
          for (const e in errors) {
            if(errors[e].length > 0) res = true
          }
          // this.disabledSubmit = false
          this.disabledSubmit = res
        },
      },
      watch: {
        'forms.gender'(){
          this.judgeGender()
        },
        'forms.age'(){
          this.judgeGender()
        },
        'forms.pref'(){
          this.judgePref()
          this.judgeGender()
        },
        'forms.facilitys'(){
          this.judgeFacilitys()
          this.judgeGender()
        },
      },
    }
    Vue.createApp(app).mount('#app')
  </script>

@include("components.footer")