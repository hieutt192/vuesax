<template>
    <div class="customer-detail">
        <vs-input
            class="mb-2 w-1/6"
            label="ID"
            placeholder="id"
            v-if="user.id"
            :value="user.id"
            disabled
        />
        <vs-input
            class="mb-3 w-full"
            label="Tên"
            placeholder="Tên"
            v-model="user.name"
        />
        <br />
        <vs-input
            class="mb-4 mt-2 w-full"
            label="Email"
            placeholder="Email"
            v-model="user.email"
        />
        <vs-input
            class="mb-4 mt-2 w-full"
            label="Số điện thoại"
            placeholder="Số điện thoại"
            v-model="user.phone"
        />

        <vs-checkbox
            class="mb-4"
            v-if="user.id"
            v-model="user.is_verified"
            disabled
            >Đã xác thực</vs-checkbox
        >
        <vs-row>
            <label class="ml-1">Role:</label>
            <div v-for="(name, index) of userType" :key="index">
                <vs-radio
                    class="mx-2"
                    v-model="user.role"
                    vs-name="user.role"
                    :val="index"
                    >{{ name }}
                </vs-radio>
            </div>
        </vs-row>
        <template>
            <div class="mt-4 flex justify-end">
                <vs-row>
                    <vs-button
                        color="success"
                        v-if="user.id"
                        @click="$emit('actionEdit')"
                        >Lưu</vs-button
                    >

                    <vs-button
                        color="primary"
                        class="mr-2"
                        v-else
                        @click="$emit('actionCreate')"
                        >Thêm mới</vs-button
                    >
                    <vs-button color="lightgray" @click="$emit('clearEvent')"
                        >Thoát</vs-button
                    >
                </vs-row>
            </div>
        </template>
    </div>
</template>

<script>
import { USER_TYPE } from "../var/user";

export default {
    name: "UserForm",
    props: {
        user: Object,
    },
    data() {
        return {
            userType: USER_TYPE,
        };
    },
    methods: {},
};
</script>

<style lang="scss" scoped>
.con-vs-checkbox {
    justify-content: flex-start;
}
</style>
