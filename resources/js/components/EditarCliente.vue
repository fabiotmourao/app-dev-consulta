<template>
  <div class="flex justify-between items-center">
    <h2 class="text-2xl py-5 font-normal font-sans">Editar Cliente</h2>
    <router-link :to="{ path: '/clientes'}" class="text-gray-400 hover:bg-gray-100 rounded-lg text-sm w-10 h-10 mr-9">
      <IconVoltar/>
    </router-link>
  </div>
  <hr class="h-px mb-8 bg-gray-200 border-0 dark:bg-gray-700" />
  <div class="h-full overflow-hidden rounded-lg">
    <form @submit.prevent="updateCliente" class="max-w-sm mx-auto">
      <div v-if="successMessage" class="bg-green-100 border text-center border-green-500 text-green-700 px-4 py-3 mb-4 rounded relative" role="alert">
        {{ successMessage }}
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" @click="fecharMensagem">
          <IconFechar/>
        </span>
      </div>
      <div v-if="errorMessage" class="bg-red-100 border text-center border-red-500 text-red-700 px-4 py-3 mb-4 rounded relative" role="alert">
        {{ errorMessage }}
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" @click="fecharMensagem">
          <IconFechar/>
        </span>
      </div>
      <div class="mb-5">
        <label for="razaosocial" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Razão Social</label>
        <input ref="razaoSocialInput" id="razaosocial" v-model="cliente.razao_social" type="text" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" :class="{ 'border-red-500': cliente.erro_razao_social }" />
        <span v-if="cliente.erro_razao_social" class="text-red-500">{{ cliente.erro_razao_social }}</span>
      </div>
      <div class="mb-5">
        <label for="cnpj" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CNPJ</label>
        <input ref="cnpjInput" id="cnpj" v-model="cliente.cnpj" v-mask="['##.###.###/####-##']" type="text" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" :class="{ 'border-red-500': cliente.erro_cnpj }" />
        <span v-if="cliente.erro_cnpj" class="text-red-500">{{ cliente.erro_cnpj }}</span>
      </div>
      <button type="submit" class="float-right text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-9 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Salvar
      </button>
    </form>
  </div>
</template>

<script>
import IconFechar from '../components/icons/IconFechar.vue';
import IconVoltar from '../components/icons/IconVoltar.vue';

export default {
  name: "EditarCliente",

  components: {
    IconFechar,
    IconVoltar,
  },

  data() {
    return {
      successMessage: '',
      errorMessage: "",
      clienteId:'',
      cliente: {
        razao_social:'',
        cnpj:'',
        erro_razao_social: '',
        erro_cnpj: ''
      },
    };
  },

  mounted() {
    this.clienteId = this.$route.params.id;
    this.getClienteData(this.$route.params.id);
  },

  methods: {
    getClienteData(clienteId) {
      axios
        .get(`/api/cliente/${clienteId}/edit`)
        .then((response) => {
          this.cliente = response.data.cliente;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    updateCliente() {
      this.cliente.cnpj = this.cliente.cnpj.replace(/[^\d]/g, '');
      axios
        .post(`/api/cliente/${this.clienteId}/update`, this.cliente)
        .then((response) => {
          this.successMessage = response.data.message;
          this.errorMessage = "";
          this.clearInputErrors();
          console.log(response);
        })
        .catch((error) => {
          if (error.response.status === 422) {
            const errors = error.response.data.errors;
            if (errors.hasOwnProperty('razao_social')) {
              this.cliente.erro_razao_social = errors.razao_social[0];
              this.$refs.razaoSocialInput.focus();
            }
            if (errors.hasOwnProperty('cnpj')) {
              this.cliente.erro_cnpj = errors.cnpj[0];
              this.$refs.cnpjInput.focus();
            }
          } else {
            console.log(error);
          }
          this.errorMessage = error.response.data.message;
          this.successMessage = "";
        });
    },

    fecharMensagem() {
        this.successMessage = "";
        this.errorMessage = "";
        this.cliente.erro_razao_social = '';
        this.cliente.erro_cnpj = '';
    },

    clearInputErrors() {
        this.cliente.erro_razao_social = '';
        this.cliente.erro_cnpj = '';
    },
  },
};
</script>
