<template>
    <sb-header type="compact" :links="links" title="Profile"></sb-header>
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <TabNav></TabNav>
        <hr class="mt-0 mb-4">
        <div class="row justify-content-center">

            <div class="col-xl-6">
                <!-- Account details card-->
                <sb-form :fields="fields" url="/change-email" :axios="axios"/>
            </div>
        </div>
    </div>
</template>

<script>
import apiService from "../../../../services/apiService";
import TabNav from "./TabNav";

export default {
    name: "ChangeEmail",
    components: {
        TabNav
    },
    data() {
        return {
            axios: apiService,
            fields: {
                email: {
                    label: 'New Email'
                },
                password: {
                    label: 'Current Password',
                    type: 'password'
                }
            }
        }
    }
}
</script>

<style scoped>

</style>
