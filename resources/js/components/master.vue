<template>
<div>
    <div class="container-fluid p-0 m-0 overflow-hidden">
        <div class="row p-0 m-0">
            <div class="col-md-12 p-0 m-0">
                <NavMenu></NavMenu>
            </div>
            
            <div class="col-md-12 p-0 m-0 bg-customCard">
              <router-view></router-view>
            </div>

            <div class="col-md-12 p-0 m-0">
                <FooterPage></FooterPage>
            </div>
        </div>
    </div>
</div>
</template>

<script>

import NavMenu from "./fontend/HeaderPage.vue"
import FooterPage from "./fontend/FooterPage.vue"
export default {
components: {
    NavMenu,
    FooterPage
  },

  props: [
    'client'
  ],

  data(){
    return{
      islogged: false,
    }
  },

  created(){
      this.$store.commit('setUpdateClient', this.client)
      //console.log(this.client)
  }
}
</script>

<style>

.max-h{
 height: max-content;
}
.div-hover:hover{
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px !important;
  transition: all .5s !important;
}

.bg-dark-custom{
  background: #000;
}
.vertical-modal{
  position: fixed;
  top: 200px;
  left: 0;
  right: 0;
  box-shadow: 0 0 5px #97ff10 !important;
  border-radius: 7px;
  color: #000 !important;
}

.vertical-modal .ivu-modal-body{
  background:linear-gradient(0deg, rgba(0, 0, 0, 0.882), rgba(78, 52, 6, 0.778)), url("/img/t2.gif");
  border-radius: 6px;
}

.login-modal .ivu-modal-body{
  background-repeat: no-repeat !important;
  background-size: cover !important;
  background:linear-gradient(0deg, rgba(0, 0, 0, 0.83), rgba(94, 21, 21, 0.585)), url("/img/constration.jpg");
  border: 3px solid rgba(20, 67, 1, 0.882);
  padding: 15px;
}

body {
  background: #ebf0f4ac;
}

.preloader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.spinner {
  border: 5px solid #1c980026;
  border-top: 5px solid #c08d00;
  border-radius: 50%;
  width: 100px;
  height: 100px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}


.vueperslides__arrow svg {
  background: #aeffbf;
  width: 20px;
  height: 55px;
  border-radius: 5px;
  border: 3px solid #ffffffcd;
}
.vueperslides__arrow--prev{
  left: -2.1em !important;
}
.vueperslides__arrow--next{
  right: -2.1em !important;
}
.icon-color {
  color: rgb(167, 78, 1);
}

.icon-color2 {
  color: rgb(0, 33, 117);
}

.border-down {
  border-bottom-left-radius: 0 !important;
  border-bottom-right-radius: 0 !important;
}
.headerFixed {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 9999;
}
.mt-50 {
  padding-top: 65px !important;
}

.zindex-100 {
    z-index: 1;
}
.btn-dark1 {
  background: linear-gradient(0.25turn, #000000, #062200, #413636);
  border-top-right-radius: 17px;
  border-bottom-left-radius: 17px;
}
.btn-dark1:hover {
  background: linear-gradient(0.25turn, #f69d3c,#000000, #398300);
  border-radius: 7px;
  transition: .3s;
}
.btn-dark2 {
  background: rgb(27, 28, 39);
}
.btn-dark2:hover {
  background: rgb(0, 0, 0);
}
.btn-dark3 {
  background: rgb(39, 32, 37);
}
.btn-dark3:hover {
  background: rgb(0, 0, 0);
}


.form-floating>label {
  color: #06802b;
  font-size: 14px;
}
.accordion-button::after {
  background-size: 12px !important;
  margin-top: 12px;
  margin-left: 12px;
}

.vr {
  color: #000 !important;
  background: #000;
  width:.5px;
}

.container-main {
  border-radius: 15px !important;
}

.ivu-icon-ios-add:before {
  color: blue;
  font-weight: 700;
}

.ivu-icon-ios-remove:before {
  color: blue;
  font-weight: 700;
}

.ivu-input-number {
  border: 0;
}

.ivu-notice {
    margin-top: 60px !important;
    color:#000;
    z-index: 999999 !important;
    
}
.ivu-notice-notice{
  border: 0 !important;
} 

.ivu-image-preview-arrow-close{
  margin-top: 70px !important;
}
.ivu-input-number-input {
  text-align: center;
  color: #000;
  background: #eeeeee7d;
  width: 60%;
  align-content: center;
  border-radius: 8px !important;
}
.ivu-icon-ios-calendar-outline:before {
  color: rgb(0, 0, 255);
  font-weight: 700;
}

.ivu-input-number-controls-outside-btn {
  background-color: #fff !important;
  border: 0;
}
.ivu-input-number-input-wrap {
  text-align: center;
}

.ivu-collapse{
  border-radius: 7px !important;
  margin: 10px;
}

.ivu-collapse-content{
    background: #fffffff0;
    border-radius: 7px !important;
    margin: 10px;
    color: #303030;
    border: .5px solid #b3b3b338;
}

.ivu-collapse-header{
    background: #f9f9f938;
    border-top-right-radius: 7px;
    border-top-left-radius: 7px;
    color: #001c49 !important;
    font-weight: 550;
    font-size: 15px;
    height: auto !important;
}

.ivu-collapse-header>.ivu-icon{
    color: #01bd23 !important;
    font-size: 17px;
}

.text-sm {
  font-size: 12px;
}  

.textt-small {
  font-size: 14px;
  font-weight: 500;
}

.margin-top-55 {
  margin-top: 55px;
}

.text-justify {
  text-align: justify;
}

.ul-li:hover {
  cursor: pointer;
  padding: .5px; 
}

.ivu-notice-notice {
    margin-top: 32px !important;
    border: 2px solid rgb(163, 0, 0);
    color:#000;
}
.w-90p{
  width: 80%;
}
.bg-darkko {
  background: rgba(0, 0, 0, 0.57);
}
.bg-darkko:hover {
  background: rgb(0, 0, 0);
}


::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px rgba(198, 17, 17, 0.703); 
  display: none;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: rgb(38, 95, 0); 
  border-radius: 20px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: rgb(80, 39, 0); 
}

.text-dark1{
    color: #000000f3;
    font-weight: bold;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

.accordion-button:not(.collapsed) {
  border-radius: 10px;
}

.data ol>li {
    margin-left: 30px !important;
}

.data ul>li {
    margin-left: 30px !important;
}

.data img {
    padding: 10px !important;
    border-radius: 17px !important;
}

.ql-editor {
    min-height: 150px !important;
}

.height-fixed{
  height: 80vh;
  overflow-y: scroll;
}

</style>