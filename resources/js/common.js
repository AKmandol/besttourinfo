//import emailjs from '@emailjs/browser';

export default {

  data(){
    return {

    }
  },  

  methods: {
    async callApi(method, url,dataObj){
        try{
            return await axios({
                method: method,
                url: url,
                data: dataObj
            });
        } catch (e){
            console.log(e)
           return e.response
        }
    
    },

    post(url,data){
        this.success = false;
        this.error = false;
        axios.post(url,data)
        .then((res) => {
            this.successMsg('Data added successfully');
            // this.reset();
            // this.$router.go();
        })
        .catch((error) => {
            if(error.response.status == 422){
                this.setErrors(error.response.data.errors);
            }else {
                this.onFailure(error.response.data.message);
            }
        })
    },

    onReady( editor )  {
        // Insert the toolbar before the editable area.
       editor.ui.getEditableElement().parentElement.insertBefore(
       editor.ui.view.toolbar.element,
       editor.ui.getEditableElement()
       )
    },

    setErrors(errors){
         this.errors = errors;
    },
    hasError(fieldName){
        return (fieldName in this.errors);
    },
    getError(fieldName){
        return this.errors[fieldName][0];
    },
    onFailure(message){
        this.error = true;
    },
    clearAllError(){
        this.errors = {};
    },
    reset(){
        this.clearAllError();
        for (let field in this.data){
            this.data[field] = '';
        }
    },

    // sendEmail() { *6Pud&avUdmj
    //   emailjs.sendForm('service_37tb2af', 'template_ar5nd5n', this.$refs.form, 'wNJ2BrypYyWnpz7fH')
    //     .then((result) => {
    //         this.successModal=true;
    //         this.footerMail.user_name= ''
    //         this.footerMail.user_email= ''
    //         this.footerMail.message= ''
    //     }, (error) => {
    //         this.error("We are sorry for the inconvience, Plese try again.");
    //     });
    // },


    successMsg (desc,title="Operation Successfull !") {
        this.$Notice.success({
            title: title,
            desc: desc
        });
    },

    errorMsg (desc,title="Something went wrong !") {
        this.$Notice.error({
            title: title,
            desc: desc
        });
    },

    infoMsg (desc,title="Notice") {
        this.$Notice.info({
            title: title,
            desc: desc,
            top: 300,
            duration: 3
        });
    },
    
  },

  computed: {
    hasAnyError(){
        return Object.keys(this.errors).length > 0;
    }
},
}
