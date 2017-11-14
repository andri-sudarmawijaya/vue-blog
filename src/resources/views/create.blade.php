@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="artikel">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Create an  Articles
                  {{-- <a href="{{route('blog.index')}}" class="btn btn-default btn-xs pull-right">Back</a> --}}
                  <button class="btn btn-default btn-xs pull-right" @click.prevent="back">Back</button>
                </div>
                <div class="panel-body">
                  <form class="form-horizontal form-validation" :state="formstate" @submit.prevent="onSubmit">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="title"> Title</label>
                            <input v-model="model.title" name="title" type="text" required autofocus placeholder="Title" class="form-control" />
                            <span v-if="errorForm['title']" class="error text-danger">@{{ errorForm['title'] }}</span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="content"> Content</label>
                            <textarea v-model="model.content" rows="4" class="form-control" name="content" id="content" placeholder="Enter your Address" required></textarea>
                            <span v-if="errorForm['content']" class="error text-danger">@{{ errorForm['content'] }}</span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="excerpt"> Excerpt</label>
                            <textarea v-model="model.excerpt" rows="4" class="form-control" name="excerpt" id="excerpt" placeholder="Enter a brief excerpt for this article - this will be used as a preview." required></textarea>
                            <span v-if="errorForm['excerpt']" class="error text-danger">@{{ errorForm['excerpt'] }}</span>
                        </div>
                    </div>
                    <div class="col-md-offset-4 col-md-8 m-t-25">
                        <button type="submit" class="btn btn-primary">Submit
                        </button>
                        <button type="reset" class="btn btn-effect-ripple btn-secondary  reset_btn1" @click.prevent="form_reset">
                            Reset
                        </button>
                        <button type="reset" class="btn btn-danger" @click.prevent="back">
                            Back
                        </button>
                    </div>
                  </form>
                  {{-- Uses a named route ------------------------------------------------}}
                  {{-- {!! Form::open(['route'=>['blog.store', 'store'], 'files'=>true]) !!}
                  @include('view::form', ['submitButtonText' => 'Create Post'])
                  {!! Form::close() !!} --}}

                  {{-- @include ('errors.list') --}}
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
var artikel = new Vue({
el: '#artikel',
data: {
article: null,
errorForm:{},
cari: null,
counter: 0,
pagination: {
  total: 0,
  per_page: 2,
  from: 1,
  to: 0,
  current_page: 1
},
offset: 4,
hapus_id:null,
notification:'',
formstate: {},
model: {
    title: "",
    content: "",
    excerpt: ""
},
},
methods: {
    onSubmit: function() {
        if (this.formstate.$invalid) {
            return;
        } else {
          var url = "{{route('blog.store')}}";
          axios.post(url, {
            title: this.model.title,
            content: this.model.content,
            excerpt: this.model.excerpt
          })
          .then(response => {window.location = "{{route('blog.index')}}";})
          .catch(errors=>{
            if(errors.response){
              if(errors.response.status = 422){
                this.errorForm = errors.response.data;
              }
            } else {
              console.error(errors);
            }
          });
        }
    },

    form_reset() {
        this.model = {
          title: "",
          content: "",
          excerpt: ""
        };
    },

    back:function(){
      window.location = "{{route('blog.index')}}";
    },
},
});

</script>
@endpush
@endsection
