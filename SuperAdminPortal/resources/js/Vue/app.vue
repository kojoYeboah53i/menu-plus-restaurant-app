<template>
<div>

</div>
    
</template>

<script>
export default {
    name: 'app',
    methods: {
        start(){
            // window.location.reload(true); 

        },
    },
    created(){
        this.start();
    }
}
</script>

<style scoped>
#email {
    width: 100%;
    height: 50px;
    padding: 0;
    margin: 0;
    border: 0;
    font-size: 16px;
    font-family: 'Open Sans', sans-serif;
    color: #fff;
    background-color: #2c3e50;
    border-radius: 4px;
    border: 1px solid #2c3e50;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    transition: all 0.3s;
    font-weight: bold;
    font-style: normal;
    text-align: center;
    outline: 0;
    box-sizing: border-box;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
</style>