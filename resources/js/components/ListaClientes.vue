<template>
    <div>
        <h2 class="text-start text-2xl py-5 font-normal font-sans">Area de clientes</h2>

        <div class="min-h-full overflow-hidden rounded-lg border-gray-200 shadow-md">
            <table  class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <thead class="bg-gray-50">
                <tr>
                <th scope="col" class="px-3 py-4 font-medium text-gray-900">Razão Social</th>
                <th scope="col" class="px-3 py-4 font-medium text-gray-900">CNPJ</th>
                <th scope="col" class="px-3 py-4 font-medium text-gray-900">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                <tr v-for="cliente in clientes" :key="cliente.id" class="hover:bg-gray-50">
                    <th class="flex gap-3 font-normal text-gray-900">
                    <div class="text-sm">
                        <td class="px-3 py-1">
                            {{ cliente.razao_social }}
                        </td>
                    </div>
                    </th>
                <td class="px-3 py-1">{{ formatarCNPJ(cliente.cnpj) }}</td>
                <td class="px-3 py-1">
                    <div class="flex justify-left gap-4">
                        <router-link :to="{  path: '/cliente/' + cliente.id + '/edit'}"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex items-center justify-center">
                            <IconEditar/>
                        </router-link>
                    </div>
                </td>
                </tr>
            </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import IconEditar from './icons/IconEditar.vue'

export default {
  name: "ListarClientes",

  components: {
    IconEditar,
  },

  data() {
    return {
      clientes: [],
    };
  },

  mounted() {
    this.getClientes();
  },

  methods: {
    getClientes() {
      axios
        .get("/api/clientes")
        .then((response) => {
          this.clientes = response.data.clientes;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    formatarCNPJ(cnpj) {
        return cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/, "$1.$2.$3/$4-$5");
    },
  },
};
</script>
