<template>

    <div>
        <h2>Danh sách sản phẩm</h2>
        <router-link class="btn btn-success" to="add-product">Thêm mới</router-link>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Name</th>
                    <!-- <th>Slug</th> -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="products.length > 0" v-for="product in products">
                    <td>{{ product.id }}</td>
                    <td>
                    <img :src="`${url_image}${product.img_thumbnail}`" width="50" alt="">
                    </td>
                    <td>{{ product.name }}</td>
                    <!-- <td>{{ product.slug }}</td> -->
                    <td>
                        <router-link class="btn btn-secondary" :to="{name: 'detail-product', params:{id: product.id}}">Show</router-link> 
                        <button class="btn btn-warning">Edit</button>
                        <button @click="onDelete(product.id)" class="btn btn-danger">Delete</button>
                    </td>
                </tr>

                <tr v-else>
                    <td colspan="4">Không có sản phẩm nào</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>

import AdminApi from '../../../config';
import { onMounted, ref } from 'vue';
import { url_image } from '../../../config';
const products = ref([]);
const getData = async () => {
    const { data } = await AdminApi.get('/products');
    products.value = data.products.data
}


onMounted(() => {
    getData()
})

const onDelete = async (id) => {


    try {

        const isDelete = confirm('Bạn có chắc muốn xoá sản phảm này không?');
        if(isDelete){
            const response = await AdminApi.delete('/products/' + id);
            if(response.data.success){
                products.value = products.value.filter(product => product.id !== id)
                alert(response.data.message);
            }
        }
    } catch (error) {
        alert(response.data.message);
    }

}
</script>

<style lang="scss" scoped>
.table {
    margin-top: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

td {
    vertical-align: middle;
}
</style>