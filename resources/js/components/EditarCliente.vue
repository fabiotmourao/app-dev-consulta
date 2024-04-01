<template>
  <h2 class="text-start text-2xl py-5 font-normal font-sans">Editar Cliente</h2>
  <hr class="h-px mb-8 bg-gray-200 border-0 dark:bg-gray-700" />

  <div class="h-full overflow-hidden rounded-lg">
    <form @submit.prevent="updateCliente" class="max-w-sm mx-auto">
      <div class="mb-5">
        <label for="razao_social" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Razão Social</label>
        <input v-model="cliente.razao_social" type="text" id="razao_social" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"/>
      </div>
      <div class="mb-5">
        <label for="cnpj" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CNPJ</label>
        <input v-model="cliente.cnpj" v-mask="['##.###.###/####-##']" type="text" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required/>
      </div>

      <button type="submit" class="float-right text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-9 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Salvar
      </button>
    </form>
  </div>
</template>

<script>
export default {
    name: "EditarCliente",
    data() {
        return {
            clienteId:'',
            cliente: {
                razao_social:'',
                cnpj:'',
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
            axios
                .post(`/api/cliente/${this.clienteId}/update`, this.cliente)
                .then((response) => {
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    },
};
</script>
