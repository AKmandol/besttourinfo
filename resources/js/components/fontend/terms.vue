<template>
    <div>
        <div v-if="isLoading" class="preloader">
            <div class="spinner"></div>
        </div>

        <div class="mt-70 container p-0">
            <div class="row">
                <!-- <p>Terms To further assist consumers who are worried about how their “Personally Identifiable Information”
                (PII) is being used online, this privacy policy has been put together. Information that can be used
                to identify, reach out to, or find a single person, or to identify a person in context, is referred 
                to as PII in US privacy law and information security. To fully understand how we gather, utilize, 
                safeguard, or otherwise handle your Personally Identifiable Information in compliance with our website,
                    please read our privacy policy carefully.
                </p> -->

                <span class="p-4 bg-white rounded" v-for="(t,i) in terms" :key="i">
                    <h6 class="fw-bold mt-4 text-dark mb-2 p-2">{{ t.title }}</h6>
                    <div class="data p-2" v-html="t.text"></div>
                </span>

            </div>
        </div>
    </div>
</template>

<script>
export default {

    data(){
        return{
            terms:[],
            isLoading: true
        }
    },

    methods: {
        async getAll(){
            const res = await this.callApi("get","home/getAllTerms");
            if (res.status == 200) {
                this.terms = res.data;
            } else {
                this.errorMsg();
            }
        }
    },
    created(){
        this.getAll();
        setTimeout(() => {
            this.isLoading = false;
        }, 1000); 
    }

}
</script>

<style scoped>
.mt-70{
    margin-top: 80px;
    margin-bottom: 50px;
    margin-left: auto;
    margin-right: auto;
}
</style>