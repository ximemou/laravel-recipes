<template>
    <input
        type="submit"
        class="btn btn-danger d-block w-100 mb-2"
        value="Eliminar"
        @click="deleteRecipe">
</template>

<script>
    export default {
        props:['recipeId'],
        mounted(){
            console.log('Recipeid es :', this.recipeId);
        },
        methods:{
            deleteRecipe(){
                this.$swal({
                    title: 'Seguro que quieres elimniar la receta?',
                    text: "Una vez eliminada no se puede recuperar!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si!',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.value) {
                        const params = {
                            id: this.recipeId
                        }
                        // send  to server
                        axios.post(`/recipes/${this.recipeId}/`, {params, _method:'delete'})
                            .then(resp=> {
                                this.$swal({
                                    title:'Receta eliminada',
                                    text:'Se elimino la receta',
                                    icon:'success'
                                });
                                //delete recipe from DOM
                                this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);

                            })
                            .catch(error=> {
                                console.log(error)
                            })
                    }
                })
            },
            deleteRec(){
                alert(this.recipeId);
            }
        }
    }
</script>
