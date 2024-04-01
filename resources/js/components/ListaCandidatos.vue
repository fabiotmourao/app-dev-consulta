<template>
  <h2 class="text-start text-2xl py-5 font-normal font-sans">
    Area de candidatos
  </h2>

  <div class="h-full overflow-hidden rounded-lg border-gray-200 shadow-md">
    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-3 py-4 font-medium text-gray-900">Nome</th>
          <th scope="col" class="px-3 py-4 font-medium text-gray-900">CPF</th>
          <th scope="col" class="px-3 py-4 font-medium text-gray-900">
            Logradouro
          </th>
          <th scope="col" class="px-3 py-4 font-medium text-gray-900">Ações</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100 border-t border-gray-100">
        <tr v-for="candidato in candidatos" :key="candidato.id" class="hover:bg-gray-50">
          <th class="flex gap-3 font-normal text-gray-900">
            <div class="text-sm">
              <td class="px-3 py-1">
                {{ candidato.nome }}
              </td>
            </div>
          </th>
          <td class="px-3 py-1">
            {{ formatarCPF(candidato.cpf) }}
          </td>
          <td class="px-3 py-1">
            {{ candidato.logradouro }}
          </td>
          <td class="px-3 py-1">
            <div class="flex justify-left gap-4">
              <button @click="abrirEditarCandidato(cliente)" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex items-center justify-center" >
                <IconEditar />
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import IconEditar from './icons/IconEditar.vue'

export default {
  components: {
    IconEditar,
  },

  data() {
    return {
      candidatos: {},
    };
  },

  mounted() {
    axios
      .get("/api/candidatos")
      .then((response) => {
        console.log(response);

        this.candidatos = response.data;
      })
      .catch((error) => {
        console.log(error);
      });
  },

  methods: {
    formatarCPF(cpf) {
    return cpf.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})$/, "$1.$2.$3-$4");
    }
  },
};
</script>
