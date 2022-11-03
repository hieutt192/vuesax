<template>
  <div id="app">
    <Nav />
    <div class="square">
      <form class="knd-form-y">
        <!-- <div class="knd-form-field"> -->
        <div class="center">
          <vs-table>
            <template #header>
              <div
                class="flex justify-between items-center m-2 mb-8 w-full"
                style="padding-top: 50px"
              >
                <div
                  class="
                    flex
                    items-center
                    justify-center
                    p-2
                    rounded
                    cursor-pointer
                    bg-gray-100
                    hover:bg-gray-200
                    border-blue-400 border-2
                  "
                >
                  <span class="font-bold">Thêm người dùng</span>
                  <vs-button circle icon floating>
                    <i class="bx bx-plus"></i>
                  </vs-button>
                </div>
                <div>
                  <vs-input
                    type="text"
                    v-model="searchFilter"
                    border
                    placeholder="Tìm kiếm theo email"
                  >
                    <template #icon>
                      <i class="bx bx-search"></i>
                    </template>
                  </vs-input>
                </div>
              </div>
            </template>
            <template #thead>
              <vs-tr>
                <vs-th sort @click="users = $vs.sortData($event, users, 'id')">
                  STT
                </vs-th>
                <vs-th
                  sort
                  @click="users = $vs.sortData($event, users, 'name')"
                >
                  Name
                </vs-th>
                <vs-th
                  sort
                  @click="users = $vs.sortData($event, users, 'email')"
                >
                  Email
                </vs-th>
                <vs-th
                  sort
                  @click="users = $vs.sortData($event, users, 'phone')"
                >
                  Phone
                </vs-th>
                <vs-th
                  sort
                  @click="users = $vs.sortData($event, users, 'role')"
                >
                  Role
                </vs-th>
                <vs-th>Action</vs-th>
              </vs-tr>
            </template>
            <template #tbody>
              <vs-tr v-for="user in fetchUser" :key="user.id">
                <vs-td>
                  {{ user.id }}
                </vs-td>
                <vs-td>
                  {{ user.name }}
                </vs-td>
                <vs-td>
                  {{ user.email }}
                </vs-td>
                <vs-td>
                  {{ user.phone }}
                </vs-td>
                <vs-td>
                  {{ user.role }}
                </vs-td>
                <vs-td>
                    <vs-button >
                    <i class='bx bx-edit'></i>
                </vs-button>
                <vs-button color="danger" v-on:click="handleClickDelete(user.id)">
                    <i class='bx bxs-trash' ></i>
                </vs-button>
                </vs-td>
              </vs-tr>
            </template>
            <template #footer>
              <vs-pagination
                v-model="page"
                :length="$vs.getLength(users, max)"
              />
            </template>
          </vs-table>
        </div>
      </form>
    </div>
  </div>
</template>

<script>

import { mapActions, mapGetters } from "vuex";

import Nav from "../layouts/NavBar.vue";

export default {
  data: () => ({
    active: false,
    page: 1,
    max: 3,
    users: [],
    user: {},
    searchFilter: '',
  }),

  computed: mapGetters(['fetchUser']),

  components: {
    Nav
    ,},

  methods: {
        ...mapActions(['createUser', 'fetchData','deleteUser', 'updateUser']),
        onSubmit() {
            let data;
            if (!this.id) {
                data = {
                    content: this.content,
                }
                this.createUser(data).then((res) => {
                    this.$store.commit('CREATE_USER', res.data.result)
                    this.$vs.notification({
                        flat: true,
                        color: 'success',
                        position: 'top-center',
                        title: 'USER Successful',
                        text: res.data.message,
                    })
                    this.content = '';
                })
            } else {

                data = {
                    id: this.id,
                    content: this.content,
                }
                this.updateUser(data).then((result) => {
                    this.$store.commit('UPDATE_USER', res.data.result)
                    this.$vs.notification({
                        flat: true,
                        color: 'success',
                        position: 'top-center',
                        title: 'Delete Successful',
                        text: res.data.message,
                    })
                })
            }



        },

        handleClickDelete(pk){
            this.deleteUser(pk).then((res) => {
                this.$store.commit('DELETE_USER',pk)
                this.$vs.notification({
                    flat: true,
                    color:'success',
                    position:'top-center',
                    title: 'Delete Successful',
                    text: res.data.message,
                })
            }).catch((err) => {
            });
        },
        handleClickUpdate(pk, content){
            this.id = pk
            this.content = content
        },
        onUpdate(){
        }
    },
    mounted() {
        this.fetchData();
    },
}

</script>

<style >
.square {
  margin-top: 4.25rem;
}
.knd-card-container {
  width: 50%;
  display: block;
  margin-left: auto;
  margin-right: auto;
}

.knd-card {
  padding: 1.25rem;
  box-shadow: 0 1px 2px 0 rgba(60, 64, 67, 0, 302),
    0 1px 3px 1px rgba(60, 64, 67, 0, 149);
  border-radius: 10px;
  margin-bottom: 1.25rem;
}

.knd-card-header {
  display: flex;
  align-items: center;
}

.knd-push {
  flex: 1 1 0%;
}

.knd-form-y {
  width: 50%;
  /* background-color: aquamarine; */
  display: block;
  margin-left: auto;
  margin-right: auto;
}

.knd-form-button {
  width: 160px;
}

.textarea {
  margin-left: 1rem;
  width: 45rem;
}

.vs-card__text {
  width: 57rem;
}
.square {
  margin-top: 4.25rem;
}
</style>
