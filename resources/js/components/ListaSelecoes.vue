<template>
  <div>
    <div class="flex justify-between items-center">
      <!-- <h2 class="text-2xl py-5 font-normal font-sans">Editar Cliente</h2> -->
      <h2 class="text-start text-2xl py-5 font-normal font-sans">
        Area de Seleção
      </h2>
      <router-link
        :to="{ path: '/selecao/create' }"
        class="text-gray-400 hover:bg-gray-100 rounded-lg text-sm w-10 h-10 mr-9"
      >
        Criar Seleção
      </router-link>
    </div>
    <div
      class="min-h-full overflow-hidden rounded-lg border-gray-200 shadow-md"
    >
      <table
        class="w-full border-collapse bg-white text-left text-sm text-gray-500"
      >
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-3 py-4 font-medium text-gray-900">
              Nome seleção
            </th>
            <th scope="col" class="px-3 py-4 font-medium text-gray-900">
              Razão Social Cliente
            </th>
            <th scope="col" class="px-3 py-4 font-medium text-gray-900">
              Nome Candidato
            </th>
            <th scope="col" class="px-3 py-4 font-medium text-gray-900">CPF</th>
            <th scope="col" class="px-3 py-4 font-medium text-gray-900">
              Data Ocorrido
            </th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
          <tr
            v-for="selecao in selecoes"
            :key="selecao.id"
            class="hover:bg-gray-50"
          >
            <th class="flex gap-3 font-normal text-gray-900">
              <div class="text-sm">
                <td class="px-3 py-2">
                  {{ selecao.nome }}
                </td>
              </div>
            </th>
            <td class="px-3 py-2">{{ selecao.cliente.razao_social }}</td>
            <td class="px-3 py-2">{{ selecao.candidato.nome }}</td>
            <td class="px-3 py-2">{{ formatarCPF(selecao.candidato.cpf) }}</td>
            <td class="px-3 py-2">{{ formatarData(selecao.created_at) }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import IconVoltar from "../components/icons/IconVoltar.vue";

export default {
  name: "ListaSelecoes",

  components: {
    IconVoltar,
  },

  data() {
    return {
      selecoes: [],
    };
  },

  mounted() {
    this.getSelecao();
  },

  methods: {
    getSelecao() {
      axios
        .get("/api/selecao")
        .then((response) => {
          this.selecoes = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    formatarData(data) {
      const d = new Date(data);
      const meses = [
        "Janeiro",
        "Fevereiro",
        "Março",
        "Abril",
        "Maio",
        "Junho",
        "Julho",
        "Agosto",
        "Setembro",
        "Outubro",
        "Novembro",
        "Dezembro",
      ];
      return `${d.getDate()} de ${meses[d.getMonth()]} de ${d.getFullYear()}`;
    },

    formatarCPF(cpf) {
      return cpf.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})$/, "$1.$2.$3-$4");
    },
  },
};
</script>
