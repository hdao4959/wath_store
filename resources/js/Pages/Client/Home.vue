<template>
    <div class="mx-5">
        <div class="mx-5 row row-cols-1 row-cols-md-4">
            <router-link class="nav-link" :to="{ name: 'product-detail', params: { slug: product.slug } }" 
              v-for="product in products" :key="product.id">
               <ProductCard :prd="product" :url_image="url_image"/>
               </router-link>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { ClientApi, url_image } from '../../config';
import ProductCard from '../../components/Client/ProductCard.vue';

const products = ref([]);
const getData = async () => {
    const { data } = await ClientApi.get('/');
    products.value = data.products.data
}

onMounted(() => {
    getData();
})
</script>

<style lang="scss" scoped>

</style>