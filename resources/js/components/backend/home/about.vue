<template>
    <div>

        <div class="p-3 m-70 bg-main rounded">
            <h4 class="color-white text-center table-border-dark bg-header fw-bold mb-3 p-3"><b-icon-signpost-2 class="d-inline text-success mr-2" width="22" height="22"></b-icon-signpost-2> Edit About Us Page</h4>

            <h6 class="color-white fw-bold pl-3 mt-4 mb-3">Old About</h6>
            <div class="bg-main table-border-dark rounded p-3">
                <span class="data" v-for="(ab,i) in about" :key="i">
                    <div v-html="ab.text"></div>
                </span>
            </div>

            <h6 class="text-success fw-bold pl-3 my-3">Update About</h6>
            <div class="bg-main table-border-dark rounded">
                <!-- <ckeditor :editor="editor" @ready="onReady" v-model="editorData" :config="editorConfig"></ckeditor> -->
                <QuillEditor v-model:content="editorData" contentType="html" toolbar="full" theme="snow" />
            </div>

            <div class="text-center">
                <a href="#" class="mt-3 btn btn-outline-success col-2 fw-bold" @click.prevent="save">Update</a>
            </div>
            
        </div>

    </div>
</template>

<script>
//import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {

    data(){
        return {
            //editor: ClassicEditor,
            editorData: '<p>Update Content of About Page.</p>',
            // editorConfig: {
            //     ckfinder: {
            //         // uploadUrl: "{{ route('createBlog.upload', ['_token' => csrf_token()])}}",
            //         uploadUrl: 'app/createBlog/upload',
                    
            //     },
            //     language: 'cs',
            //     image: {
            //         toolbar: [
            //         'imageTextAlternative',
            //         'imageStyle:side',
            //         ]
            //     },
            //     toolbar: [ 'heading','|','bold', 'italic', '|', 'link' ],
            //     table: {
            //         contentToolbar: [
            //         'tableColumn',
            //         'tableRow',
            //         'mergeTableCells'
            //         ]
            //     },
                
            // },

            about:null,

            data: {
                jsonData: null,
                post: ''
            },
        }
    },

    methods: {
        // onReady( editor )  {
        //      // Insert the toolbar before the editable area.
        //     editor.ui.getEditableElement().parentElement.insertBefore(
        //     editor.ui.view.toolbar.element,
        //     editor.ui.getEditableElement()
        //     )
        // },
        async save(){
            //var data = response;
            this.data.post = this.editorData;
            this.data.jsonData = this.editorData;
            console.log(this.data.jsonData)
            const res = await this.callApi('post', 'home/create-about', this.data);
            if(res.status === 200) {
                this.successMsg('Data added Succesfully');
                this.$router.go();
            }
            else {
                this.errorMsg();
            }
      
        },

        async getAbout() {
          const res = await this.callApi("get", "home/get/about");
          if (res.status == 200) {
              this.about = res.data;
          } else {
              this.errorMsg();
          }
        },
    },

    async created(){
        this.getAbout();
    }

}
</script>

<style>
.m-70 {
  margin-top: 30px;
  margin-bottom: 20px;
  height: 100vh;
  overflow-y: scroll;
}
.ck-content{
    height: 50vh !important;
    overflow-y: scroll !important;
}

</style>