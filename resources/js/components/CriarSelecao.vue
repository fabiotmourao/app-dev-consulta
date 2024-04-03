<template>
  <div class="flex justify-between items-center">
    <h2 class="text-2xl py-5 font-normal font-sans">Criar Seleção</h2>
    <router-link
      :to="{ path: '/selecao' }"
      class="text-gray-400 hover:bg-gray-100 rounded-lg text-sm w-10 h-10 mr-9"
    >
      <IconVoltar />
    </router-link>
  </div>
  <hr class="h-px mb-8 bg-gray-200 border-0 dark:bg-gray-700" />
  <div class="h-full overflow-hidden rounded-lg">
    <form @submit.prevent="createSelecao" class="max-w-sm mx-auto">
      <div
        v-if="successMessage"
        class="bg-green-100 border text-center border-green-500 text-green-700 px-4 py-3 mb-4 rounded relative"
        role="alert"
      >
        {{ successMessage }}
        <span
          class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer"
          @click="fecharMensagem"
        >
          <IconFechar />
        </span>
      </div>
      <div
        v-if="errorMessage"
        class="bg-red-100 border text-center border-red-500 text-red-700 px-4 py-3 mb-4 rounded relative"
        role="alert"
      >
        {{ errorMessage }}
        <span
          class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer"
          @click="fecharMensagem"
        >
          <IconFechar />
        </span>
      </div>
      <div class="mb-5">
        <label
          for="nome"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Nome</label
        >
        <input
          ref="nomeInput"
          id="nome"
          v-model="selecao.nome"
          type="text"
          class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
          :class="{ 'border-red-500': erroNome }"
        />
        <span v-if="erroNome" class="text-red-500">{{ erroNome }}</span>
      </div>
      <div class="mb-5">
        <label
          for="cliente"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Selecione Cliente</label
        >
        <select
          v-model="selectedCliente"
          id="cliente"
          :class="{ 'border-red-500': erroCliente }"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        >
          <option value="">Selecione um cliente</option>
          <option
            v-for="cliente in clientes"
            :key="cliente.id"
            :value="cliente.id"
          >
            {{ cliente.razao_social }}
          </option>
        </select>
        <span v-if="erroCliente" class="text-red-500">{{ erroCliente }}</span>
      </div>
      <div class="mb-5">
        <label
          for="candidato"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Selecione Candidato</label
        >
        <select
          v-model="selectedCandidato"
          id="candidato"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        >
          <option value="">Selecione um candidato</option>
          <option
            v-for="candidato in candidatos"
            :key="candidato.id"
            :value="candidato.id"
          >
            {{ candidato.nome }}
          </option>
        </select>
        <span v-if="erroCandidato" class="text-red-500">{{
          erroCandidato
        }}</span>
      </div>
      <button
        type="submit"
        class="float-right text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-9 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
      >
        Salvar
      </button>
    </form>
  </div>
</template>

<script>
import IconFechar from "./icons/IconFechar.vue";
import IconVoltar from "./icons/IconVoltar.vue";

export default {
  name: "CriarSelecao",

  components: {
    IconFechar,
    IconVoltar,
  },

  data() {
    return {
      clientes: [],
      candidatos: [],
      selectedCliente: "",
      selectedCandidato: "",
      selecao: {
        nome: "",
      },
      erroNome: "",
      erroCliente: "",
      erroCandidato: "",
      successMessage: "",
      errorMessage: "",
    };
  },

  mounted() {
    this.fetchClientes();
    this.fetchCandidatos();
  },

  methods: {
    fetchClientes() {
      axios
        .get("/api/clientes")
        .then((response) => {
          console.log(response);
          this.clientes = response.data.clientes;
        })
        .catch((error) => {
          console.error("Error fetching clientes:", error);
        });
    },

    fetchCandidatos() {
      axios
        .get("/api/candidatos")
        .then((response) => {
          console.log(response);
          this.candidatos = response.data.candidatos;
        })
        .catch((error) => {
          console.error("Error fetching candidatos:", error);
        });
    },

    createSelecao() {
      const data = {
        nome: this.selecao.nome,
        cliente_id: this.selectedCliente,
        candidato_id: this.selectedCandidato,
      };

      axios
        .post("/api/selecao/create", data)
        .then((response) => {
          this.successMessage = response.data.message;
          this.selecao.nome = "";
          this.selectedCliente = "";
          this.selectedCandidato = "";
        })
        .catch((error) => {
          if (error.response && error.response.status === 422) {
            const errors = error.response.data.errors;
            if (errors.hasOwnProperty("nome")) {
              this.erroNome = errors.nome[0];
            }
            if (errors.hasOwnProperty("cliente_id")) {
              this.erroCliente = errors.cliente_id[0];
            }
            if (errors.hasOwnProperty("candidato_id")) {
              this.erroCandidato = errors.candidato_id[0];
            }
          } else {
            console.log(error);
          }
          this.errorMessage = error.response
            ? error.response.data.message
            : "Erro desconhecido";
          this.successMessage = "";
        });
    },

    fecharMensagem() {
      this.successMessage = "";
      this.errorMessage = "";
      this.erroNome = "";
      this.erroCliente = "";
      this.erroCandidato = "";
    },

  },
};
</script>
