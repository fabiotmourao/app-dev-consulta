<template>
  <div class="flex">
    <div class="w-96 max-h-full bg-purple-700 text-white" v-show="showSide">
      <div class="h-[50px] bg-purple-700  flex justify-start  items-center ">
        <div class="px-[20px]">
          <h3 class="font-bold text-xl">Dashboard</h3>
        </div>
      </div>
      <div class="h-[calc(100vh-50px)] bg-purple-700 py-[20px]">
        <div class="flex flex-col justify-between h-full px-[20px] space-y-[10px]">
          <div class=" flex flex-col justify-between space-y-[10px]">
            <router-link :to="{ name: 'Clientes'}" class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-gray-200 hover:bg-gray-200 hover:text-gray-800  transition duration-400 ease-in-out">
                <IconCLiente/>
              Clientes
            </router-link>
            <router-link :to="{ name: 'Candidatos'}" class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-gray-200 hover:bg-gray-300  hover:text-gray-800 transition duration-400 ease-in-out">
                <IconCandidato/>
              Candidatos
            </router-link>
            <router-link :to="{ name: 'Selecao'}" class="inline-flex relative items-center py-[10px] px-[10px] w-full text-sm font-medium rounded-md border-gray-200 hover:bg-gray-300  hover:text-gray-800 transition duration-400 ease-in-out">
                <IconSelecao/>
              Seleção
            </router-link>
          </div>
        </div>
      </div>
    </div>
    <div class="w-full h-full  overflow-y-auto">
      <div class="h-full bg-gray-100 flex items-center shadow-sm px-[20px] w-full py-[10px] z-10 border-b ">
        <div class="cursor-pointer w-[30px]" @click="toggleSideBar">
            <IconHamburger/>
        </div>
      </div>
      <div class="max-h-full p-[20px]">
        <div class=" rounded-md  h-full">
          <router-view></router-view>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import IconCLiente from '../components/icons/IconCliente.vue';
import IconCandidato from '../components/icons/IconCandidato.vue';
import IconSelecao from '../components/icons/IconSelecao.vue';
import IconHamburger from '../components/icons/IconHamburger.vue';


export default {
  components:{
    IconCLiente,
    IconCandidato,
    IconHamburger,
    IconSelecao
  },

  data() {
    return {
      showDropDown: false,
      showSide: true
    }
  },

  methods: {
    toggleSideBar() {
      this.showSide = !this.showSide

    },

    toggleDrop() {
      this.showDropDown = !this.showDropDown

    }
  },

}
</script>

<style>

</style>
