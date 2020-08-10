<template>
    <div>
        <span class="like-btn" @click="likeRecipe" :class="{'like-active': isActive}"></span>
        <p> {{ numberOfLikes }} Les gusto la receta</p>
    </div>
</template>

<script>
export default {
    props:['recipeId','like','likes'],
    data: function(){
        return{
            isActive: this.like,
            totalLikes: this.likes
        }
    },
    methods:{
        likeRecipe(){
            axios.post('/recipes/'+this.recipeId)
            .then(resp=>{
                if(resp.data.attached.length >0){
                    this.$data.totalLikes++;
                }else{
                    this.$data.totalLikes--;
                }
                this.isActive = !this.isActive
            })
            .catch(error => {
                if(error.response.status === 401){
                    window.location = '/register';
                }
            });
        }
    },
    computed: {
        numberOfLikes: function(){
            return this.totalLikes
        }
    }
}
</script>
