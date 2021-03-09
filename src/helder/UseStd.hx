package helder;

import haxe.macro.Type;
import haxe.macro.Context;

using haxe.macro.TypeTools;

class UseStd {
  static final stdPaths = ['haxe', 'sys'];
  static final root = [
    'Any', 'Array', 'Class', 'Date', 'DateTools', 'EReg', 'Enum', 'EnumValue', 
    'IntIterator', 'Lambda', 'List', 'Map', 'Math', 'Expr', 'Reflect', 'Std',
    'StdTypes', 'String', 'StringBuf', 'StringTools', 'Sys', 'Type', 'UInt', 
    'UnicodeString', 'Xml'
  ];
  static final exclude = ['haxe.macro', 'php.Boot', 'haxe.Exception', 'genes.Genes'];

  public static function use() {
    if (Context.defined('php'))
      excludeAsNative(['php'].concat(stdPaths), (pack, type) -> {
        final path = if (pack == '') [] else pack.split('.');
        final name = if (pack == '' && type.name == 'Array') 'Array_hx' else type.name;
        final native = ['helder', 'std'].concat(path).concat([name]).join('\\');
        type.meta.add(':native', [macro $v{native}], type.pos);
      });
    else if (Context.defined('genes'))
      excludeAsNative(['js', 'genes'].concat(stdPaths), (pack, type) -> {
        final path = type.module.split('.');
        final name = type.name;
        final from = ['helder.std'].concat(path).join('/') + '.js';
        type.meta.add(':jsRequire', [macro $v{from}, macro $v{name}], type.pos);
      });
  }

  static function includesPack(packs:Array<String>, pack:String) {
    for (p in packs)
      if (pack == p || StringTools.startsWith(pack, p + '.'))
        return true;
    return false;
  }

  static function excludeAsNative(packs:Array<String>, makeNative:(pack:String, type:BaseType) -> Void) {
    Context.onGenerate(function(types) {
      for (type in types) {
        switch type {
          case TInst((_.get() : BaseType) => base, _) | TEnum((_.get() : BaseType) => base, _):
            final pack = base.pack.join('.');
            final isRootType = pack == '' && root.indexOf(base.name) > -1;
            final isIncluded = includesPack(packs, pack);
            if (!isRootType && !isIncluded)
              continue;
            if (base.isExtern)
              continue;
            final meta = base.meta;
            if (includesPack(exclude, base.module))
              continue;
            if (!meta.has(":nativeGen")) {
              meta.add(":hxGen", [], base.pos);
              makeNative(pack, base);
            }
            base.exclude();
          default:
        }
      }
    }, false);
  }
}
