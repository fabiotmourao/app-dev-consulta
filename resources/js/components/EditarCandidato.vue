<template>
  <div class="flex justify-between items-center">
    <h2 class="text-2xl py-5 font-normal font-sans">Editar Candidato</h2>
    <router-link :to="{ path: '/candidatos'}" class="text-gray-400 hover:bg-gray-100 rounded-lg text-sm w-10 h-10 mr-9">
      <IconVoltar/>
    </router-link>
  </div>
  <hr class="h-px mb-8 bg-gray-200 border-0 dark:bg-gray-700" />
  <div class="h-full overflow-hidden rounded-lg">
    <form @submit.prevent="updateCandidato" class="max-w-sm mx-auto">
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
        <label for="nome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
        <input ref="nomeInput" id="nome" v-model="candidato.nome" type="text" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
        :class="{ 'border-red-500': candidato.erro_nome }" />
        <span v-if="candidato.erro_nome" class="text-red-500">{{ candidato.erro_nome }}</span>
      </div>
      <div class="mb-5">
        <label for="cpf" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CPF</label>
        <input ref="cpfInput" id="cpf" v-model="candidato.cpf" v-mask="['###.###.###-##']" type="text" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
        :class="{ 'border-red-500': candidato.erro_cpf }" />
        <span v-if="candidato.erro_cpf" class="text-red-500">{{ candidato.erro_cpf }}</span>
      </div>
      <div class="mb-5">
        <label for="logradouro" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Logradouro</label>
        <input ref="logradouroInput" id="logradouro" v-model="candidato.logradouro" type="text" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
        :class="{ 'border-red-500': candidato.erro_logradouro }" />
        <span v-if="candidato.erro_logradouro" class="text-red-500">{{ candidato.erro_logradouro }}</span>
      </div>
      <button type="submit" class="float-right text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-9 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Salvar
      </button>
    </form>
  </div>
</template>

<script>
import IconFechar from './icons/IconFechar.vue';
import IconVoltar from './icons/IconVoltar.vue';

export default {
  name: "EditarCandidato",

  components: {
    IconFechar,
    IconVoltar,
  },

  data() {
    return {
      successMessage: '',
      errorMessage: "",
      candidatoId:'',
      candidato: {
        nome:'',
        cpf:'',
        logradouro:'',
        erro_nome: '',
        erro_cpf: '',
        erro_logradouro: ''
      },
    };
  },

  mounted() {
    this.candidatoId = this.$route.params.id;
    this.getCandidatoData(this.$route.params.id);
  },

  methods: {
    getCandidatoData(candidatoId) {
      axios
        .get(`/api/candidato/${candidatoId}/edit`)
        .then((response) => {
          this.candidato = response.data.candidato;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    updateCandidato() {
      this.candidato.cpf = this.candidato.cpf.replace(/[^\d]/g, '');
      axios
        .post(`/api/candidato/${this.candidatoId}/update`, this.candidato)
        .then((response) => {
          this.successMessage = response.data.message;
          this.errorMessage = "";
          this.clearInputErrors();
        })
        .catch((error) => {
          if (error.response.status === 422) {
            const errors = error.response.data.errors;
            if (errors.hasOwnProperty('nome')) {
              this.candidato.erro_nome = errors.nome[0];
              this.$refs.nomeInput.focus();
            }
            if (errors.hasOwnProperty('cpf')) {
              this.candidato.erro_cpf = errors.cpf[0];
              this.$refs.cpfInput.focus();
            }
            if (errors.hasOwnProperty('logradouro')) {
              this.candidato.erro_logradouro = errors.logradouro[0];
              this.$refs.logradouroInput.focus();
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
        this.candidato.erro_nome = '';
        this.candidato.erro_cpf = '';
        this.candidato.erro_logradouro = '';

    },

    clearInputErrors() {
        this.candidato.erro_nome = '';
        this.candidato.erro_cpf = '';
        this.candidato.erro_logradouro = '';
    },
  },
};
</script>
